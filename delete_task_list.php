<?php
include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_section_id'])) {
    $section_id = intval($_POST['delete_section_id']);
    
    $stmt = $conn->prepare("DELETE FROM task_sections WHERE section_id = ?");
    $stmt->bind_param('i', $section_id);

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