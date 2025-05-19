<?php 

$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "davud";


$conn = mysqli_connect($servername, $username, $password_db, $dbname);

if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>