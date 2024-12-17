<?php
// Include the database connection
include('connection.php');
session_start(); // Start the session

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the email and password from POST request
    $email = $_POST['email'];
    $password = $_POST['password'];
    

    // Check if the connection is established
    if (!$admin_conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Escape the inputs to prevent SQL injection
    $email = mysqli_real_escape_string($admin_conn, $email);

    // Query to fetch the user with the provided email
    $sql = "SELECT * FROM adminreg WHERE email = '$email'";
    $result = mysqli_query($admin_conn, $sql);

    // Check if the user exists
    if ($result && mysqli_num_rows($result) === 1) {
        $user = mysqli_fetch_assoc($result); // Fetch user data
        $hashedPassword = $user['password'];

        // Verify the password
        if (password_verify($password, $hashedPassword)) {
            // Start the session and store user details
            $_SESSION['username'] = $user['first_name']; // Assuming 'name' is the user's name column
            $_SESSION['email'] = $user['email'];

            // Redirect to the dashboard
            header("Location: dash.php");
            exit();
        } else {
            // Password mismatch
            header("Location:../userjs/login.php");
        }
    } else {
        // No user found with this email
        header("Location:../userjs/login.php");
    }

    // Close the database connection
    mysqli_close($admin_conn);
} else {
    // If the form was not submitted, redirect to the login page
    header("Location:../userjs/login.php");
    exit();
}
?>