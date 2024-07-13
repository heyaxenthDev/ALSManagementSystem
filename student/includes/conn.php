<?php 

$host = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "als_ms_db";


// Create connection
$conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " .$conn->connect_error);
}

// echo "Connected successfully";

// // Close connection
// $conn->close();
?>