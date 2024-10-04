<?php
include 'db_connect.php'; // Include your database connection file

//DELETE THE LIST WHEN CLICKED
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_section_id'])) {
    $section_id = intval($_POST['delete_section_id']);
    
    $stmt = $conn->prepare("DELETE FROM task_sections WHERE section_id = ?");
    $stmt->bind_param('i', $section_id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

//DELETE TASK FROM THE ITS LIST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = isset($_POST['task_id']) ? intval($_POST['task_id']) : 0;

    if (isset($_POST['action'])) {
        if ($task_id > 0) {
            if ($_POST['action'] === 'delete') {
                $stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = ?");
                $stmt->bind_param("i", $task_id);

                if ($stmt->execute()) {
                    if ($stmt->affected_rows > 0) {
                        echo "Task deleted successfully.";
                        header("Location: index.php"); 
                        exit;
                    } else {
                        echo "No task found with the specified ID or it may have already been deleted.";
                    }
                } else {
                    echo "Error executing query: " . $stmt->error;
                }
            } elseif ($_POST['action'] === 'update') {
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

//UPDATE WHEN RADIO BUTTON CLICKED
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected_task'])) {
        $task_id = intval($_POST['selected_task']);
        
        $sql = "UPDATE tasks SET status = 'completed' WHERE task_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $task_id);
        
        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        } else {
            echo "Error updating task: " . $stmt->error;
        }
        $stmt->close();
    }
}
$conn->close();
?>