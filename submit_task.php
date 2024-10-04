<?php
include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the data from the POST request
    $section_id = $_POST['section_id'];
    $title = trim($_POST['title']);
    $dueDate = $_POST['due_date'];
    $created_at = date('Y-m-d H:i:s');
    $status = 'pending'; 

    $stmt = $conn->prepare("INSERT INTO tasks (section_id, title, status, created_at , due_date) VALUES (?, ?, ?, ?,?)");
    $stmt->bind_param("issss", $section_id, $title, $status, $created_at, $dueDate);

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
