<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL root password
$dbname = "elearning";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
