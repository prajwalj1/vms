<?php
$conn = new mysqli("localhost", "root", "", "prajwalsbl");
if ($conn->connect_error) {
    die("Could not connect to the database: " . $conn->connect_error);
}


// SQL to create the approved_requests table
$sql = "
CREATE TABLE approved_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255),
    email VARCHAR(255),
    vehicle_number VARCHAR(255),
    service_type VARCHAR(255),
    service_date DATE,
    additional_notes TEXT


)";

// Execute the query and check for success
if ($conn->query($sql) === TRUE) {
    echo "Table 'approved_requests' created successfully.";
} else {
    echo "Error creating table: " . $conn->error;
}

// Close the connection
$conn->close();
?>
