<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['vehicle_number'])) {
    echo json_encode(['error' => 'Vehicle number is required']);
    exit;
}

$vehicleNumber = $_GET['vehicle_number'];

try {
    $admin_conn = new PDO("mysql:host=localhost;dbname=prajwalsbl", 'root', '');
    $admin_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Make sure the table name is correct (approved_requests or your actual table name)
    $stmt = $admin_conn->prepare("SELECT * FROM approved_requests WHERE vehicle_number = :vehicle_number");
    $stmt->bindParam(':vehicle_number', $vehicleNumber);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(['exists' => true]);
    } else {
        echo json_encode(['exists' => false]);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>

