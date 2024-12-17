<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prajwalsbl"; // Replace with your database name

// Create connection
$admin_conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($admin_conn->connect_error) {
    die("Connection failed: " . $admin_conn->connect_error);
}
$sql="
CREATE TABLE repair_tracking (

    id INT AUTO_INCREMENT PRIMARY KEY,
    vehicle_number VARCHAR(50) NOT NULL,
    repair_status TEXT NOT NULL,
    inventory_items TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

)";
// Execute the `service_requests` table creation
if ($admin_conn->query($sql) === TRUE) {
    echo "Table created successfully.<br>";
} else {
    echo "Error creating  table: " . $admin_conn->error . "<br>";
}

// Close connection
$admin_conn->close();
?>

