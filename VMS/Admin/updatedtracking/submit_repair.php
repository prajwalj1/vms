<?php
// Include database connection
include '../connection.php';

header('Content-Type: application/json');

// Decode JSON data from the POST request
$data = json_decode(file_get_contents('php://input'), true);

// Validate incoming data
if (isset($data['vehicle_number'], $data['repair_status'], $data['inventory'])) {
    $vehicleNumber = $data['vehicle_number'];
    $repairStatus = $data['repair_status']; // Array of repair statuses
    $inventory = $data['inventory']; // Array of inventory items with quantities

    try {
        // Begin transaction
        $admin_conn->begin_transaction();

        // Concatenate repair statuses into a comma-separated string
        $repairStatusString = implode(',', $repairStatus);

        // Convert inventory array to JSON string
        $inventoryString = json_encode($inventory);

        // Check if the vehicle number already exists
        $checkQuery = "SELECT id FROM repair_tracking WHERE vehicle_number = ?";
        $stmt = $admin_conn->prepare($checkQuery);
        if (!$stmt) {
            throw new Exception("Error preparing check query: " . $admin_conn->error);
        }

        $stmt->bind_param("s", $vehicleNumber);
        if (!$stmt->execute()) {
            throw new Exception("Error executing check query: " . $stmt->error);
        }

        $stmt->bind_result($existingId);
        $vehicleExists = $stmt->fetch();
        $stmt->close();

        if ($vehicleExists) {
            // Update existing record
            $updateQuery = "UPDATE repair_tracking SET repair_status = ?, inventory_items = ? WHERE id = ?";
            $stmt = $admin_conn->prepare($updateQuery);
            if (!$stmt) {
                throw new Exception("Error preparing update query: " . $admin_conn->error);
            }

            $stmt->bind_param("ssi", $repairStatusString, $inventoryString, $existingId);
            if (!$stmt->execute()) {
                throw new Exception("Error executing update query: " . $stmt->error);
            }
            $stmt->close();
        } else {
            // Insert new record
            $insertQuery = "INSERT INTO repair_tracking (vehicle_number, repair_status, inventory_items) VALUES (?, ?, ?)";
            $stmt = $admin_conn->prepare($insertQuery);
            if (!$stmt) {
                throw new Exception("Error preparing insert query: " . $admin_conn->error);
            }

            $stmt->bind_param("sss", $vehicleNumber, $repairStatusString, $inventoryString);
            if (!$stmt->execute()) {
                throw new Exception("Error executing insert query: " . $stmt->error);
            }
            $stmt->close();
        }

        // Update inventory stock
        foreach ($inventory as $item) {
            $itemId = $item[0];
            $quantityUsed = $item[1];

            // Check current stock
            $stockQuery = "SELECT item_quantity FROM inventory WHERE id = ?";
            $stmt = $admin_conn->prepare($stockQuery);
            if (!$stmt) {
                throw new Exception("Error preparing stock query: " . $admin_conn->error);
            }

            $stmt->bind_param("i", $itemId);
            if (!$stmt->execute()) {
                throw new Exception("Error executing stock query: " . $stmt->error);
            }

            $stmt->bind_result($currentStock);
            if (!$stmt->fetch()) {
                throw new Exception("Item ID $itemId not found in inventory.");
            }
            $stmt->close();

            // Deduct stock and delete if quantity becomes 0
            $newStock = $currentStock - $quantityUsed;

            if ($newStock < 0) {
                throw new Exception("Insufficient stock for item ID $itemId. Current stock: $currentStock, required: $quantityUsed");
            }

            if ($newStock > 0) {
                $updateQuery = "UPDATE inventory SET item_quantity = ? WHERE id = ?";
                $stmt = $admin_conn->prepare($updateQuery);
                if (!$stmt) {
                    throw new Exception("Error preparing update query: " . $admin_conn->error);
                }
                $stmt->bind_param("ii", $newStock, $itemId);
            } else {
                $deleteQuery = "DELETE FROM inventory WHERE id = ?";
                $stmt = $admin_conn->prepare($deleteQuery);
                if (!$stmt) {
                    throw new Exception("Error preparing delete query: " . $admin_conn->error);
                }
                $stmt->bind_param("i", $itemId);
            }

            if (!$stmt->execute()) {
                throw new Exception("Error executing update/delete query: " . $stmt->error);
            }
            $stmt->close();
        }

        // Commit transaction
        $admin_conn->commit();

        // Success response
        echo json_encode(['success' => true, 'message' => 'Repair status and inventory updated successfully']);
    } catch (Exception $e) {
        // Rollback transaction in case of error
        $admin_conn->rollback();
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    }
} else {
    // Invalid data response
    echo json_encode(['success' => false, 'message' => 'Invalid data provided']);
}
?>
