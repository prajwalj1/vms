
<?php
$mysqli = new mysqli("localhost", "root", "", "prajwaldbl");
if($mysqli){
    $sql = "SELECT * FROM praz";
    if($rs = $mysqli->query($sql)){
        if($rs->num_rows > 0){
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>id</th>";
                echo "<th>Name</th>";
                echo "<th>Password</th>";
                echo "</tr>";
                while($row = $rs->fetch_array()){
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['password'] . "</td>";
                    echo "</tr>";
                }
            echo "</table>";
            $rs->free();
        }else{
          echo "No records matching your query were found.";
        }
    }else{
         echo "Could not able to execute $sql. " . $mysqli->error;
    }
}else{
    die("Could not connect. " . $mysqli->connect_error);
}
$mysqli->close();
?>