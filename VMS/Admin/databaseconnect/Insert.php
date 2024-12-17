<?php
// Initialize an empty errors array
$errors = array();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form values
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $gender = $_POST['gender'];
    $country = $_POST['country'];
    $terms = isset($_POST['terms']) ? 1 : 0;

    // Form validation
    if (empty($first_name)) {
        $errors['first_name'] = "First name is required";
    }

    if (empty($last_name)) {
        $errors['last_name'] = "Last name is required";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "A valid email is required";
    }

    if (empty($password)) {
        $errors['password'] = "Password is required";
    }

    if ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match";
    }

    if (empty($gender)) {
        $errors['gender'] = "Please select your gender";
    }

    if (empty($country)) {
        $errors['country'] = "Please select your country";
    }

    if ($terms != 1) {
        $errors['terms'] = "You must accept the terms and conditions";
    }

    // If there are no errors, proceed with database insertion
    if (empty($errors)) {
        // Database connection
        $conn = new mysqli("localhost", "root", "", "prajwalsbl");

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Encrypt the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the data into the database
        $sql = "INSERT INTO adminreg (first_name, last_name, email, password, gender, country, terms)
                VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $first_name, $last_name, $email, $hashed_password, $gender, $country, $terms);

        if ($stmt->execute()) {



            echo "<script>
            alert('created request sucessfully !');
            window.location.href = '../../userjs/login.php';
          </script>";
        }
    }
}