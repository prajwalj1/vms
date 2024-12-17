<?php
$vehicleNumber = $_GET['vehicle_number'];
$conn = new PDO("mysql:host=localhost;dbname=prajwalsbl", 'root', '');

$stmt = $conn->prepare("SELECT * FROM approved_request WHERE vehicle_number = :vehicle_number");
$stmt->bindParam(':vehicle_number', $vehicleNumber);
$stmt->execute();

echo json_encode(['exists' => $stmt->rowCount() > 0]);
?>
