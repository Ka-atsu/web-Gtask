<?php 
include 'db_connect.php';

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if((isset($_POST['update_title']) && !empty($_POST['update_title'])) &&
       (isset($_POST['update_due_date']) && !empty($_POST['update_due_date'])))
    {
        $update_section_id = $_POST['update_section_id'];
        $update_task_id = $_POST['update_task_id'];
        $update_title = $_POST['update_title'];
        $update_due_date = $_POST['update_due_date'];

        $stmt = $conn->prepare("UPDATE task_sections as ts INNER JOIN tasks as t ON ts.section_id = t.section_id
                            SET t.title = ?, t.due_date = ?
                            WHERE ts.section_id = ? AND t.task_id = ?");
        $stmt->bind_param("ssii", $update_title, $update_due_date, $update_section_id, $update_task_id);

        if($stmt->execute())
        {
            header('Location: index.php');
            exit;
        } 
        else
        {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
$conn->close();
?>