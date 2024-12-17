<?php
// Database connection
$host = 'localhost';
$dbname = 'prajwalsbl';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if required POST data is set
    if (!isset($_POST['item_name']) || !isset($_POST['item_quantity']) || !isset($_POST['item_price'])) {
        echo json_encode(['error' => 'Missing required fields']);
        exit;
    }

    // Get input data
    $itemName = $_POST['item_name'];
    $itemQuantity = intval($_POST['item_quantity']);
    $itemPrice = floatval($_POST['item_price']);

    // Check if the item already exists
    $stmt = $conn->prepare("SELECT * FROM inventory WHERE item_name = :item_name");
    $stmt->bindParam(':item_name', $itemName);
    $stmt->execute();
    $existingItem = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingItem) {
        // Update the item_quantity and item_price if the item exists
        $newQuantity = $existingItem['item_quantity'] + $itemQuantity;
        $updateStmt = $conn->prepare("
            UPDATE inventory 
            SET item_quantity = :item_quantity, item_price = :item_price 
            WHERE item_name = :item_name
        ");
        $updateStmt->bindParam(':item_quantity', $newQuantity);
        $updateStmt->bindParam(':item_price', $itemPrice);
        $updateStmt->bindParam(':item_name', $itemName);
        $updateStmt->execute();
        echo json_encode(['message' => 'Item quantity and price updated successfully']);
    } else {
        // Insert a new item
        $insertStmt = $conn->prepare("
            INSERT INTO inventory (item_name, item_quantity, item_price) 
            VALUES (:item_name, :item_quantity, :item_price)
        ");
        $insertStmt->bindParam(':item_name', $itemName);
        $insertStmt->bindParam(':item_quantity', $itemQuantity);
        $insertStmt->bindParam(':item_price', $itemPrice);
        $insertStmt->execute();
        echo json_encode(['message' => 'Item added successfully']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
