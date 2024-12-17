<?php
$conn = new mysqli("localhost", "root", "", "prajwaldbl");
if ($conn->connect_error) {
    die("Could not connect to the database: " . $conn->connect_error);
}

// Check if the table already exists
$table_check = $conn->query("SHOW TABLES LIKE 'rems'");
if ($table_check->num_rows == 0) {
    $sql =  "CREATE TABLE  rems (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        vehicle_number VARCHAR(50) NOT NULL,
        reminder_date DATE NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
  
    )";
    if ($conn->query($sql)) {
        echo "Table created successfully.";
    } else {
        echo "Could not execute $sql. " . $conn->error;
    }
} else {
    echo "Table already exists.";
}

$conn->close();
?>