<?php
ini_set('display_errors', 0);  // Disable error display in response
ini_set('log_errors', 1);      // Enable error logging
ini_set('error_log', 'php_errors.log'); // Specify the log file

try {
    $admin_conn = new PDO("mysql:host=localhost;dbname=prajwalsbl", 'root', '');
    $admin_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $admin_conn->query("SELECT id, item_name, item_quantity FROM inventory");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
