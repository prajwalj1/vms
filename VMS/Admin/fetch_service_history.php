<?php
// Database connection settings
$server = "localhost";
$username = "root";
$password = "";
$dbname = "prajwalsbl";

// Establish database connection
$conn = new mysqli($server, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

// Check if vehicle_number is sent as a GET parameter
if ($_SERVER['REQUEST_METHOD'] === "GET" && isset($_GET['vehicle_number'])) {
    $vehicle_number = $conn->real_escape_string($_GET['vehicle_number']);

    // Query the database for the history of this vehicle number
    $sql = "SELECT * FROM approved_requests WHERE vehicle_number = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        http_response_code(500);
        echo json_encode(["error" => "Failed to prepare query"]);
        exit();
    }

    $stmt->bind_param("s", $vehicle_number);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch data
    $history = [];
    while ($row = $result->fetch_assoc()) {
        $history[] = $row;
    }

    // Send JSON response
    echo json_encode($history);
} else {
    http_response_code(400);
    echo json_encode(["error" => "Invalid request"]);
}

$conn->close();
?>
