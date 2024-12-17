<?php
// Database connection settings
$server = "localhost";
$username = "root";
$password = "";

// Connect to `prajwaldbl` database
$conn = new mysqli($server, $username, $password, "prajwaldbl");
if ($conn->connect_error) {
    die("Connection failed to prajwaldbl: " . $conn->connect_error);
}

// Connect to `prajwalsbl` database
$admin_conn = new mysqli($server, $username, $password, "prajwalsbl");
if ($admin_conn->connect_error) {
    die("Connection failed to prajwalsbl: " . $admin_conn->connect_error);
}

// Check if ID and action are passed
if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = intval($_GET['id']);
    $action = $_GET['action'];

    if ($action === 'approve') {
        // Fetch the record to approve from `service_requests_1`
        $fetchSql = "SELECT * FROM service_requests_1 WHERE id = ?";
        $stmt = $conn->prepare($fetchSql);

        if (!$stmt) {
            die("Fetch Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row) {
            // Insert data into the `approved_requests` table in `prajwalsbl` database
            $insertSql = "INSERT INTO approved_requests (full_name, email, vehicle_number, service_type, service_date, additional_notes) 
                          VALUES (?, ?, ?, ?, ?, ?)";
            $insertStmt = $admin_conn->prepare($insertSql);

            if (!$insertStmt) {
                die("Insert Prepare failed: " . $admin_conn->error);
            }

            $insertStmt->bind_param(
                "ssssss",
                $row['name'],
                $row['email'],
                $row['vehicle_number'],
                $row['service_type'],
                $row['preferred_date'],
                $row['additional_notes']
            );

            if ($insertStmt->execute()) {
                // Delete the record from `service_requests_1`
                $deleteSql = "DELETE FROM service_requests_1 WHERE id = ?";
                $deleteStmt = $conn->prepare($deleteSql);

                if (!$deleteStmt) {
                    die("Delete Prepare failed: " . $conn->error);
                }

                $deleteStmt->bind_param("i", $id);

                if ($deleteStmt->execute()) {
                    echo "<script>
                            alert('Request approved and moved to the approved_request table.');
                            window.location.href = 'service_completed.php';
                          </script>";
                } else {
                    echo "<script>
                            alert('Failed to delete the request from service_requests_1 after approval.');
                            window.location.href = 'service_completed.php';
                          </script>";
                }
                $deleteStmt->close();
            } else {
                echo "<script>
                        alert('Failed to approve the request.');
                        window.location.href = 'service_completed.php';
                      </script>";
            }

            $insertStmt->close();
        } else {
            echo "<script>
                    alert('No data found for the given request.');
                    window.location.href = 'service_completed.php';
                  </script>";
        }
    } elseif ($action === 'reject') {
        // Simply delete the record from `service_requests_1`
        $deleteSql = "DELETE FROM service_requests_1 WHERE id = ?";
        $deleteStmt = $conn->prepare($deleteSql);

        if (!$deleteStmt) {
            die("Delete Prepare failed: " . $conn->error);
        }

        $deleteStmt->bind_param("i", $id);

        if ($deleteStmt->execute()) {
            echo "<script>
                    alert('Request rejected and deleted from service_requests_1.');
                    window.location.href = 'service_completed.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Failed to reject the request.');
                    window.location.href = 'service_completed.php';
                  </script>";
        }

        $deleteStmt->close();
    } else {
        echo "<script>
                alert('Invalid action.');
                window.location.href = 'service_completed.php';
              </script>";
    }
} else {
    echo "<script>
            alert('Invalid request.');
            window.location.href = 'service_completed.php';
          </script>";
}

// Close database connections
$conn->close();
$admin_conn->close();
?>
