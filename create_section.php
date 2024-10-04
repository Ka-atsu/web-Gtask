<?php
include 'db_connect.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $section_name = trim($_POST['section_name']);

    $stmt = $conn->prepare("INSERT INTO task_sections (section_name) VALUES (?)");
    $stmt->bind_param("s", $section_name);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
