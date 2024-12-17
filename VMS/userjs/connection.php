<?php
// Connection to `prajwaldbl` for user data
$conn = new mysqli('localhost', 'root', '', 'prajwaldbl');

// Check connection for `prajwaldbl`
if ($conn->connect_error) {
    die("Error: Could not connect to prajwaldbl. " . $conn->connect_error);
}

// Connection to `prajwalsbl` for admin data
$admin_conn = new mysqli('localhost', 'root', '', 'prajwalsbl');

// Check connection for `prajwalsbl`
if ($admin_conn->connect_error) {
    die("Error: Could not connect to prajwalsbl. " . $admin_conn->connect_error);
}
?>
