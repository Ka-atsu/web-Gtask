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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the task ID from the form
    $task_id = isset($_POST['task_id']) ? intval($_POST['task_id']) : 0;

    // Check if action is set
    if (isset($_POST['action'])) {
        if ($task_id > 0) {
            if ($_POST['action'] === 'delete') {
                // Prepare the SQL statement to prevent SQL injection
                $stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = ?");
                $stmt->bind_param("i", $task_id);

                // Execute the statement
                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        echo "Task deleted successfully.";
                    } else {
                        echo "No task found with the specified ID or it may have already been deleted.";
                    }
                } else {
                    echo "Error executing query: " . $stmt->error;
                }
            } elseif ($_POST['action'] === 'update') {
                // Handle update logic here
                // You may want to redirect to an update form or process the update directly
                echo "Update functionality not implemented yet.";
            }
            $stmt->close();
        } else {
            echo "Invalid task ID.";
        }
    } else {
        echo "No action specified.";
    }
} else {
    echo "Invalid request method.";
}

$conn->close();
header("Location: index.php"); 
?>