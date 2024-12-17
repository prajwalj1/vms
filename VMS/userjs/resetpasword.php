<?php
// Include database connection
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $lastname = $_POST['lastname'];

    // SQL Query to check the user
    $sql = "SELECT * FROM register WHERE email = ? AND last_name = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }
    $stmt->bind_param("ss", $email, $lastname);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Match found, redirect to password reset form
        header("Location: updatepasword.php?email=" . urlencode($email));
        exit();
    } else {
        echo "<script>alert('Invalid email or last name!'); window.history.back();</script>";
    }
}
?>
