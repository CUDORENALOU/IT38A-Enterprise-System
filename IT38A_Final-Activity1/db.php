<?php
// Correctly define database connection variables
$host = "localhost";
$username = "root";
$password = ""; // leave empty if using XAMPP default
$database = "hardwarehub";

// Create the database connection
$conn = new mysqli($host, $username, $password, $database);

// Check for connection error
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
