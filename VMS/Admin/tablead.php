<?php
$admin_conn = new mysqli("localhost", "root", "", "prajwalsbl");
if ($admin_conn->connect_error) {
    die("Could not connect to the database: " . $admin_conn->connect_error);
}

// Check if the table already exists
$table_check = $admin_conn->query("SHOW TABLES LIKE 'adminreg'");
if ($table_check->num_rows == 0) {
    $sql = "CREATE TABLE adminreg(
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(50) NOT NULL,
        last_name VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        gender ENUM('Male', 'Female') NOT NULL,
        country VARCHAR(50),
        terms BOOLEAN
    )";
    if ($admin_conn->query($sql)) {
        echo "Table created successfully.";
    } else {
        echo "Could not execute $sql. " . $admin_conn->error;
    }
} else {
    echo "Table already exists.";
}

$admin_conn->close();
?>