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
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Escape the inputs to prevent SQL injection
    $email = mysqli_real_escape_string($conn, $email);

    // Query to fetch the user with the provided email
    $sql = "SELECT * FROM register WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

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
            header("Location:login.php");
        }
    } else {
        // No user found with this email
        header("Location:login.php");
    }

    // Close the database connection
    mysqli_close($conn);
} else {
    // If the form was not submitted, redirect to the login page
    header("Location: login.php");
    exit();
}
?>