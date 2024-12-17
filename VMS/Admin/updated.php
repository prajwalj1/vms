<?php
// Database connection settings
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

// Get ID and action from the query string
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'approve') {
        $status = 'Approved';
        $subject = "Service Request Approved";
    } elseif ($action === 'reject') {
        $status = 'Rejected';
        $subject = "Service Request Rejected";
    } else {
        die("Invalid action");
    }

    // Update the status in the database
    $sql = "UPDATE service_requests SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $status, $id);

    if ($stmt->execute()) {
        // Fetch email and request details
        $detailsQuery = "SELECT email, vehicle_number, details FROM service_requests WHERE id = ?";
        $detailsStmt = $conn->prepare($detailsQuery);
        $detailsStmt->bind_param("i", $id);
        $detailsStmt->execute();
        $detailsStmt->bind_result($userEmail, $vehicleNumber, $requestDetails);
        $detailsStmt->fetch();
        $detailsStmt->close();

        if ($userEmail) {
            // Prepare email message
            if ($action === 'approve') {
                $message = "Dear Customer,\n\nYour service request has been approved.\n\nVehicle Number: {$vehicleNumber}\nDetails: {$requestDetails}\n\nPlease schedule a suitable date for the service.\n\nThank you!";
            } elseif ($action === 'reject') {
                $message = "Dear Customer,\n\nYour service request has been rejected.\n\nVehicle Number: {$vehicleNumber}\nDetails: {$requestDetails}\n\nUnfortunately, the requested slot is not available.\n\nThank you!";
            }

            // Send email to the user
            $headers = "prajwal.gautam2727@gmail.com\r\n";
            if (mail($userEmail, $subject, $message, $headers)) {
                echo "<script>
                        alert('Request {$status} successfully! Email sent to the user.');
                        window.location.href = 'approve.php';
                      </script>";
            } else {
                echo "<script>
                        alert('Request {$status}, but email could not be sent.');
                        window.location.href = 'approve.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('Request {$status}, but user email not found.');
                    window.location.href = 'approve.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Failed to update request status.');
                window.location.href = 'approve.php';
              </script>";
    }

    $stmt->close();
}

$conn->close();
?>
