<?php
// Database connection details
$host = 'localhost'; // Database host
$dbname = 'prajwalsbl'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // SQL statement to create the inventory table
    $sql = "CREATE TABLE IF NOT EXISTS inventory (
        id INT AUTO_INCREMENT PRIMARY KEY,
        item_name VARCHAR(255) NOT NULL UNIQUE,
        item_quantity INT NOT NULL,
        item_price DECIMAL(10, 2) NOT NULL
    )";

    // Execute the SQL statement
    $conn->exec($sql);

    echo "Table 'inventory' created successfully.";
} catch (PDOException $e) {
    // Handle any errors
    echo "Error creating table: " . $e->getMessage();
}
?>
