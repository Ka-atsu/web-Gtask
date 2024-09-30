<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .flatpickr-calendar {
            background-color: white !important;
            border: 1px solid #ccc;
        }
        .flatpickr-day {
            background-color: white !important;
            color: #333;
        }
        .flatpickr-day.selected {
            background-color: #007bff !important;
            color: white !important;
        }
        .flatpickr-day:hover, .flatpickr-day:focus {
            background-color: #e0e0e0 !important;
            color: #000;
        }
        .task-list {
            display: none; 
            list-style-type: none;
            padding: 0;
        }
        .task-list.visible {
            display: block;
        }
        .dropdown-btn {
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="off-screen-menu" id="off-screen-menu">
        <ul class="nav-links">
            <li><button data-task-target="#create-task-box">Create Task</button></li>
            <li><button data-task-target="#create-list-box">Create New List +</button></li>
        </ul>
    </div>

    <!-- Create Task Box -->
    <div class="create-task-box" id="create-task-box">
        <div class="Closing-tab">
            <button data-close-button class="close-button">&times;</button>
        </div>
        <div class="Input">
            <form action="submit_task.php" method="POST">
                <select name="section_id" required>
                    <option value="">Select List</option>
                    <?php
                    include 'db_connect.php'; // Ensure this file contains your DB connection
                    // Fetch sections to populate the dropdown
                    $sql_sections = "SELECT * FROM task_sections";
                    $result_sections = $conn->query($sql_sections);
                    while ($section = $result_sections->fetch_assoc()) {
                        echo "<option value='" . $section['section_id'] . "'>" . htmlspecialchars($section['section_name']) . "</option>";
                    }
                    ?>
                </select>
                <input type="text" name="title" class="title" placeholder="ADD Task Title" required>
                <input type="datetime-local" class="form-control" name="task_date" placeholder="Select DateTime" style="color: white;">
                <button class="create-task-btn">Create Task</button>
            </form>
        </div>
    </div>

    <!-- Create List Box -->
    <div class="create-list-box" id="create-list-box">
        <div class="Closing-tab">
            <button data-close-button class="close-button">&times;</button>
        </div>
        <div class="Input">
            <form action="create_section.php" method="POST">
                <input type="text" name="section_name" class="title" placeholder="New List Name" required>
                <button class="create-task-btn">Create New List</button>
            </form>
        </div>
    </div>

    <div id="overlay"></div>

    <nav class="navbar">
        <h1>TASK MANAGER</h1>
        <div class="hamburger" id="hamburger">
            <div class="hamburger-content">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <div class="allTasks" id="allTasks">
        <?php
        // Fetch task sections (lists)
        $sql_sections = "SELECT * FROM task_sections";
        $result_sections = $conn->query($sql_sections);

        if ($result_sections->num_rows > 0) {
            while ($section = $result_sections->fetch_assoc()) {
                // Here's where the new div with class 'task-section' is added:
                echo '<div class="task-section">';  // Creates a new box for each task section
                echo '<button data-close-button class="close-button">⋮</button>';
                echo "<strong>" . htmlspecialchars($section['section_name']) . "</strong>";
                
                // Fetch tasks for this section
                $section_id = $section['section_id'];
                $sql_tasks = "SELECT * FROM tasks WHERE section_id = $section_id";
                $result_tasks = $conn->query($sql_tasks);

                if ($result_tasks->num_rows > 0) {
                    echo "<ul>";
                    while ($task = $result_tasks->fetch_assoc()) {
                        echo "<li>" . htmlspecialchars($task['title']) . " - Status: " . htmlspecialchars($task['status']) . "</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No tasks in this list.</p>";
                }

                echo '</div>';  // Closing the 'task-section' div for each section
            }
        } else {
            echo "<p>No lists found.</p>";
        }
        ?>
    </div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="main.js"></script>
    <script>
        const config = {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        }
        flatpickr("input[type=datetime-local]", config);
    </script>
</body>
</html>
