<?php
$servername = "localhost"; // Update if needed
$username = "root"; // Replace with your MySQL username
$password = ""; // Replace with your MySQL password

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set charset to avoid character set issues
$conn->set_charset("utf8");

// Create database
$dbname = "task_manager";
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database '$dbname' created successfully.<br>";
} else {
    echo "Error creating database: " . $conn->error;
}

// Select the created database
$conn->select_db($dbname);

// Create task_sections table
$taskSection = "CREATE TABLE IF NOT EXISTS task_sections (
    section_id INT AUTO_INCREMENT PRIMARY KEY,
    section_name VARCHAR(255) NOT NULL
)";

// Execute query to create task_sections table
if ($conn->query($taskSection) === TRUE) {
    echo "Table 'task_sections' created successfully (if not already exists).<br>";
} else {
    echo "Error creating 'task_sections' table: " . $conn->error;
}

// Create tasks table
$tasks = "CREATE TABLE IF NOT EXISTS tasks (
    task_id INT AUTO_INCREMENT PRIMARY KEY,
    section_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    status ENUM('pending', 'completed') DEFAULT 'pending',
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (section_id) REFERENCES task_sections(section_id) ON DELETE CASCADE
)";

// Execute query to create tasks table
if ($conn->query($tasks) === TRUE) {
    echo "Table 'tasks' created successfully (if not already exists).<br>";
} else {
    echo "Error creating 'tasks' table: " . $conn->error;
}

?>
