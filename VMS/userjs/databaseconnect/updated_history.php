<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prajwaldbl"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($action === 'approve') {
    // Insert into service_history table
    $historySql = "INSERT INTO service_history (vehicle_number, service_type, service_date, notes) VALUES (?, ?, ?, ?)";
    $historyStmt = $conn->prepare($historySql);

    if (!$historyStmt) {
        die("Prepare failed: " . $conn->error);
    }

    $notes = "Service approved for " . $fullName;
    $historyStmt->bind_param("ssss", $vehicleNumber, $serviceType, $serviceDate, $notes);

    if (!$historyStmt->execute()) {
        echo "<script>
                alert('Failed to save service history.');
                window.location.href = 'dash.php';
              </script>";
    }
    $historyStmt->close();
}
