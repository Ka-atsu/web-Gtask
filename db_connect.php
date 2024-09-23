<?php
$servername = "localhost"; // Update if needed
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password
$dbname = "task_manager"; // Name of the database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
