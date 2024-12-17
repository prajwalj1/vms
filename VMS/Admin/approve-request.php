<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "prajwaldbl"; // Ensure this matches your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch records from the database
$sql = "SELECT id, name, email, vehicle_number, service_type, preferred_date, additional_notes FROM service_requests";

$result = $conn->query($sql);
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Requests - Admin Panel</title>
    <link rel="stylesheet" href="admin/admin-panel.css"> <!-- Optional for styling -->
</head>
<body>
    <div class="container">
        <h1>📋 Admin Panel - Service Requests</h1>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Vehicle Number</th>
                    <th>Service Type</th>
                    <th>Service Date</th>
                    <th>Additional Notes</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td>{$row['email']}</td>
                                <td>{$row['vehicle_number']}</td>
                                <td>{$row['service_type']}</td>
                                <td>{$row['preferred_date']}</td>
                                <td>{$row['additional_notes']}</td>
                                <td>
                                    <a href='approve_action.php?id={$row['id']}&action=approve'>Approve</a> | 
                                    <a href='approve_action.php?id={$row['id']}&action=reject'>Reject</a>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No service requests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
