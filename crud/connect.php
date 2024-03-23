<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "paradise";


// $servername = "localhost";
// $username = "u709996704_foods";
// $password = "Foods@123";
// $dbname = "u709996704_foods";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>