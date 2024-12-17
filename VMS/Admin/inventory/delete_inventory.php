<?php
// Database connection
$host = 'localhost';
$dbname = 'prajwalsbl';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the item ID is provided
    if (!isset($_GET['id'])) {
        echo json_encode(['error' => 'Item ID is required']);
        exit;
    }

    $itemId = intval($_GET['id']);

    // Delete the item from the database
    $stmt = $conn->prepare("DELETE FROM inventory WHERE id = :id");
    $stmt->bindParam(':id', $itemId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Item deleted successfully']);
    } else {
        echo json_encode(['error' => 'Failed to delete the item']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
