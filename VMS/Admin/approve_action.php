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

    // Check if ID and action are passed via GET
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $id = intval($_GET['id']);
        $action = $_GET['action'];

        // Determine status based on action
        if ($action === 'approve') {
            $status = 'Approved';
            $subject = "Service Request Approved";
        } elseif ($action === 'reject') {
            $status = 'Rejected';
            $subject = "Service Request Rejected";
        } else {
            die("Invalid action");
        }

        // Fetch request details from database
        $sql = "SELECT name, email, vehicle_number, service_type, preferred_date FROM service_requests WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->bind_result($fullName, $email, $vehicleNumber, $serviceType, $serviceDate);
        $stmt->fetch();
        $stmt->close();

        if ($email) {
            // Prepare email content
            if ($action === 'approve') {
                $message = "Dear $fullName,\n\nYour service request has been approved.\n\nVehicle Number: $vehicleNumber\nService Type: $serviceType\nService Date: $serviceDate\n\nPlease schedule a suitable date for the service.\n\nThank you!";
            } elseif ($action === 'reject') {
                $message = "Dear $fullName,\n\nWe regret to inform you that your service request has been rejected.\n\nVehicle Number: $vehicleNumber\nService Type: $serviceType\nService Date: $serviceDate\n\nUnfortunately, the requested slot is not available.\n\nThank you for understanding.";
            }

            // Send email
            $headers = "From: prajwal.gautam2727.com\r\n";
            $emailSent = mail($email, $subject, $message, $headers);

            // Delete the record from the database
            $deleteSql = "DELETE FROM service_requests WHERE id = ?";
            $deleteStmt = $conn->prepare($deleteSql);
            if (!$deleteStmt) {
                die("Prepare failed: " . $conn->error);
            }
            $deleteStmt->bind_param("i", $id);
            if ($deleteStmt->execute()) {
                if ($emailSent) {
                    echo "<script>
                            alert('Request {$status} successfully! Email sent to the user.');
                            window.location.href = 'approve-request.php';
                        </script>";
                } else {
                    echo "<script>
                            alert('Request {$status} successfully! But email could not be sent.');
                            window.location.href = 'approve-request.php';
                        </script>";
                }
            } else {
                echo "<script>
                        alert('Failed to delete the request from the database.');
                        window.location.href = 'approve-request.php';
                    </script>";
            }
            $deleteStmt->close();
        } else {
            echo "<script>
                    alert('No user details found for the given request.');
                    window.location.href = 'approve-request.php';
                </script>";
        }
    } else {
        echo "<script>
                alert('Invalid request.');
                window.location.href = 'approve-request.php';
            </script>";
    }

    $conn->close();
    ?>
