<?php
$host = 'localhost';
$dbname = 'prajwalsbl';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT * FROM inventory");
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($inventory);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
