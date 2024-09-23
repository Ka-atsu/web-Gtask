<?php
include 'db_connect.php';

$sql = "SELECT * FROM tasks ORDER BY task_date ASC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<li>" . $row['title'] . " - " . $row['task_date'] . "</li>";
    }
} else {
    echo "<li>No tasks found</li>";
}

$conn->close();
?>
