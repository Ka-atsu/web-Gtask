<?php
include 'db_connect.php';
$section_id = 1; // Example for "Work" section
$sql = "SELECT * FROM tasks WHERE section_id = $section_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Task: " . $row['title'] . " - Status: " . $row['status'] . "<br>";
    }
} else {
    echo "No tasks found for this section.";
}
