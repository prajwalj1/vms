<?php 
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $newpassword = $_POST['password'];
    $confirmpassword = $_POST['confirm_password'];

    if ($newpassword !== $confirmpassword) {
        echo "<script>alert('Passwords do not match!'); window.history.back();</script>";
        exit();
    }

    // Hash the new password
    $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $sql = "UPDATE adminreg SET password = ? WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $hashed_password, $email);

    if ($stmt->execute()) {
        echo "<script>alert('Password updated successfully!'); window.location.href = 'vms/userjs/login.php';</script>";
     
    } else {
        echo "<script>alert('Error updating password!'); window.location.href = 'updatepasword.php';</script>";
        exit();
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reset-container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        .reset-container h2 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        .reset-container p {
            font-size: 14px;
            color: #666;
            text-align: center;
            margin-bottom: 20px;
        }

        .reset-container .form-group {
            margin-bottom: 20px;
        }

        .reset-container label {
            font-size: 14px;
            color: #555;
            display: block;
            margin-bottom: 8px;
        }

        .reset-container input {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .reset-container input:focus {
            border-color: #2575fc;
        }

        .reset-container button {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            color: #fff;
            background: #2575fc;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
        }

        .reset-container button:hover {
            background: #6a11cb;
        }

        .reset-container .back-link {
            display: block;
            text-align: center;
            font-size: 14px;
            color: #2575fc;
            margin-top: 10px;
            text-decoration: none;
        }

        .reset-container .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="reset-container">
        <h2>Reset Your Password</h2>
        <p>Please enter your email address and create a new password.</p>
        <form action="" method="post">
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required placeholder="Enter your registered email">
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" required placeholder="Enter your new password">
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required placeholder="Re-enter your new password">
            </div>
            <button type="submit">Reset Password</button>
            <a href="/vms/userjs/login.php" class="back-link">Back to Login</a>
        </form>
    </div>
</body>

</html>


