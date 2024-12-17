<?php
$admin_conn = new mysqli("localhost", "root", "");
if($admin_conn){
    $sql = "CREATE DATABASE  prajwalsbl"; 
    if($admin_conn->query($sql)){ 
       echo "Database created successfully";
     }
    else{
        echo "Could not able to execute $sql" . $admin_conn->error;
    }
}
else{
    die("Problem in connect in database".$admin_conn->connect_error);
}
$admin_conn->close();
?>