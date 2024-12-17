<?php
header('Content-Type: application/json');

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prajwaldbl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Connection failed']);
    exit();
}

// Check if vehicle_number is passed
if (isset($_GET['vehicle_number'])) {
    $vehicle_number = $_GET['vehicle_number'];

    // Query to fetch history
    $sql = "SELECT service_type, service_date, notes FROM service_history WHERE vehicle_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $vehicle_number);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $history = [];
        while ($row = $result->fetch_assoc()) {
            $history[] = $row;
        }
        echo json_encode($history);
    } else {
        echo json_encode(['error' => 'Query failed']);
    }

    $stmt->close();
} else {
    echo json_encode(['error' => 'Vehicle number not provided']);
}

$conn->close();
?>
