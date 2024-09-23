<?php
include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the POST request
    $section_id = $_POST['section_id'];
    $title = trim($_POST['title']);
    $task_date = $_POST['task_date'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO tasks (section_id, title, description, status, created_at) VALUES (?, ?, '', 'pending', ?)");
    $stmt->bind_param("iss", $section_id, $title, $task_date);

    // Execute the statement
    if ($stmt->execute()) {
        // Redirect back to index.php after successful insertion
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
}
$conn->close();
?>
