<?php
// $servername = "localhost";
$servername = "http://10.10.10.77:3306";
$username = "admin";
$password = "206274";
$dbname = "syslog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
var_dump($conn);
// // Check connection
// if ($conn->connect_error) {
//   die("Connection failed: " . $conn->connect_error);
// }

// $sql = "SELECT id, firstname, lastname FROM users";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   echo "<table><tr><th>ID</th><th>Name</th></tr>";
//   // output data of each row
//   while($row = $result->fetch_assoc()) {
//     echo "<tr><td>".$row["id"]."</td><td>".$row["firstname"]." ".$row["lastname"]."</td></tr>";
//   }
//   echo "</table>";
// } else {
//   echo "0 results";
// }
$conn->close();
?>