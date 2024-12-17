<?php
$conn = new mysqli("localhost", "root", "");
if($conn){
    $sql = "CREATE DATABASE prajwaldbl"; 
    if($conn->query($sql)){ 
       echo "Database created successfully";
     }
    else{
        echo "Could not able to execute $sql" . $conn->error;
    }
}
else{
    die("Problem in connect in database".$conn->connect_error);
}
$conn->close();
?>