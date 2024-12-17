<?php
// Include database connection
// include 'connection.php';

// header('Content-Type: application/json');

// try {
//     // Get the vehicle number from the request
//     $vehicleNumber = $_GET['vehicle_number'] ?? '';

//     if (empty($vehicleNumber)) {
//         throw new Exception("Vehicle number is required.");
//     }

    // // Query the database for the vehicle number
    // $query = "SELECT repair_status FROM repair_tracking WHERE vehicle_number = ?";
    // $stmt = $admin_conn->prepare($query);
    // $stmt->bind_param("s", $vehicleNumber);
    // $stmt->execute();
    // $result = $stmt->get_result();

    // if ($result->num_rows === 0) {
    //     // No matching vehicle number found
    //     echo json_encode(["success" => false, "message" => "Vehicle not found."]);
    //     exit();
    // }

    // $items = [];
    // while ($row = $result->fetch_assoc()) {
    //     $items[] = $row['repair_status'];
    // }

//     echo json_encode(["success" => true, "data" => $items]);
// } catch (Exception $e) {
//     echo json_encode(["success" => false, "message" => $e->getMessage()]);
// }

// Close the database connection
// $admin_conn->close();
// 














// Include database connection
include 'connection.php';

header('Content-Type: application/json');

try {
    $vehicleNumber = $_GET['vehicle_number'] ?? '';

    if (empty($vehicleNumber)) {
        throw new Exception("Vehicle number is required.");
    }

    // Query the database for the vehicle number
    $query = "SELECT repair_status FROM repair_tracking WHERE vehicle_number = ?";
    $stmt = $admin_conn->prepare($query);
    $stmt->bind_param("s", $vehicleNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        echo json_encode(["success" => false, "message" => "Vehicle not found."]);
        exit();
    }

    $data = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode(["success" => true, "data" => $data]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}

$admin_conn->close();
?>
