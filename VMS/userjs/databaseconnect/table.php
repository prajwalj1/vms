<?php
$conn = new mysqli("localhost", "root", "", "prajwaldbl");
if ($conn->connect_error) {
    die("Could not connect to the database: " . $conn->connect_error);
}

// Check if the table already exists
$table_check = $conn->query("SHOW TABLES LIKE 'register'");
if ($table_check->num_rows == 0) {
    $sql = "CREATE TABLE register(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        gender ENUM('Male', 'Female') NOT NULL,
        country VARCHAR(50),
        terms BOOLEAN
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