<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prajwalsbl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate inputs
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $vehicle_number = mysqli_real_escape_string($conn, $_POST['vehicle_number']);
    $reminder_date = mysqli_real_escape_string($conn, $_POST['reminder_date']);

    $today = new DateTime();
    $chosen_date = new DateTime($reminder_date);

    if ($chosen_date < $today) {
        die("Error: Reminder date cannot be in the past.");
    }

    // Calculate the interval between today and the chosen date
    $interval = $today->diff($chosen_date);

    // Immediate notification for scheduling
    $subject = "Vehicle Service Scheduled";
    $message = "Dear $name,\n\nYour vehicle ($vehicle_number) service is scheduled for $reminder_date.\n\nThank you!";
    $headers = "From: prajwal.gautam2727@gmail.com";

    if (mail($email, $subject, $message, $headers)) {
        echo "Immediate scheduling notification sent!";
    } else {
        echo "Failed to send scheduling notification.";
    }

    // Insert the record into the 'rems' table
    $sql = "INSERT INTO  adminrems (name, email, vehicle_number, reminder_date) 
            VALUES ('$name', '$email', '$vehicle_number', '$reminder_date')";

    if ($conn->query($sql) === TRUE) {
        // If the reminder date is tomorrow
        if ($interval->days == 1 && $interval->invert == 0) {
            $subject = "Vehicle Service Reminder - Scheduled for Tomorrow";
            $message = "Dear $name,\n\nYour vehicle ($vehicle_number) service is scheduled for tomorrow ($reminder_date).\n\nThank you!";
            
            if (mail($email, $subject, $message, $headers)) {
                echo "Reminder email for tomorrow sent successfully!";
            } else {
                echo "Failed to send reminder email.";
            }
        }

        // Save future reminders in the schedule table
        $status = 'pending';
        $schedule_sql = "INSERT INTO adminschedule (email, subject, message, send_date, status) 
                         VALUES ('$email', 
                                 'Vehicle Service Reminder', 
                                 'Dear $name,\n\nThis is a reminder for your vehicle ($vehicle_number). Your service is scheduled for $reminder_date.', 
                                 '$reminder_date', 
                                 '$status')";

        if ($conn->query($schedule_sql) === TRUE) {
            echo "Reminder saved successfully for the future.";
        } else {
            echo "Error saving reminder: " . $conn->error;
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
