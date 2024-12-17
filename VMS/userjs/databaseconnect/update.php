<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prajwaldbl";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$today = (new DateTime())->format('Y-m-d');

// Fetch pending reminders due today
$sql = "SELECT * FROM schedule WHERE send_date = '$today' AND status = 'pending'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];
        $subject = $row['subject'];
        $message = $row['message'];
        $id = $row['id']; // Assuming each reminder has a unique ID
        $headers = "From: prajwal.gautam2727@gmail.com";

        // Send email
        if (mail($email, $subject, $message, $headers)) {
            // Update status to 'sent'
            $update_sql = "UPDATE schedule SET status = 'sent' WHERE id = $id";
            if ($conn->query($update_sql) === TRUE) {
                echo "Reminder sent and status updated for ID: $id\n";
            } else {
                echo "Error updating status for ID: $id - " . $conn->error . "\n";
            }
        } else {
            echo "Failed to send reminder email for ID: $id\n";
        }
    }
} else {
    echo "No reminders due today.";
}

$conn->close();
?>
