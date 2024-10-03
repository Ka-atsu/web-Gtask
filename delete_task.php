<?php
include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action']) && isset($_POST['task_id'])) {
        $action = $_POST['action'];
        $task_id = intval($_POST['task_id']);

        if ($action === 'delete') {
            $stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = ?");
            $stmt->bind_param('i', $task_id);

            if ($stmt->execute()) {
                // Redirect back to index.php after successful deletion
                header("Location: index.php");
                exit;
            } else {
                echo "Error deleting task: " . $stmt->error;
            }

            $stmt->close();
        } 
    }
}
$conn->close();
?>