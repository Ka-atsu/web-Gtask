<?php
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $task_date = $_POST['task_date'];

    $sql = "INSERT INTO tasks (title, task_date) VALUES ('$title', '$task_date')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Task added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
?>
