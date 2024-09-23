<?php
include 'db_connect.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the section name from the POST request
    $section_name = trim($_POST['section_name']);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO task_sections (section_name) VALUES (?)");
    $stmt->bind_param("s", $section_name);

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
