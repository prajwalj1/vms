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

// SQL to create the first `service_requests_1` table
$sql_service_requests_1 = "
CREATE TABLE IF NOT EXISTS service_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    vehicle_number VARCHAR(50) NOT NULL,
    service_type VARCHAR(50) NOT NULL,
    preferred_date DATE NOT NULL,
    additional_notes TEXT,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending'
)";

// Execute the `service_requests` table creation
if ($conn->query($sql_service_requests_1) === TRUE) {
    echo "Table 'service_requests' created successfully.<br>";
} else {
    echo "Error creating 'service_requests' table: " . $conn->error . "<br>";
}

// SQL to create the second `service_requests` table
$sql_service_requests_1 = "
CREATE TABLE IF NOT EXISTS service_requests_1 (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    vehicle_number VARCHAR(50) NOT NULL,
    service_type VARCHAR(50) NOT NULL,
    preferred_date DATE NOT NULL,
    additional_notes TEXT,
        status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending'
)";

// Execute the `service_requests` table creation
if ($conn->query($sql_service_requests_1) === TRUE) {
    echo "Table 'service_requests_1' created successfully.<br>";
} else {
    echo "Error creating 'service_requests_1' table: " . $conn->error . "<br>";
}

// Close connection
$conn->close();
?>
