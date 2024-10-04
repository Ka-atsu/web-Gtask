<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="off-screen-menu" id="off-screen-menu">
        <ul class="nav-links">
            <li><button data-task-target="#create-task-box">Create Task +</button></li>
            <li><button data-task-target="#create-list-box">Create New List</button></li>
        </ul>
    </div>

    <!-- Create Task Box -->
    <div class="create-task-box" id="create-task-box">
        <div class="Closing-tab">
            <button data-close-button class="close-button">&times;</button>
        </div>
        <div class="Input">
            <form action="submit_task.php" method="POST">
                <select name="section_id" class="custom-select" required>
                    <option value="">Select List</option>
                    <?php
                    include 'db_connect.php'; 
                    $sql_sections = "SELECT * FROM task_sections";
                    $result_sections = $conn->query($sql_sections);
                    while ($section = $result_sections->fetch_assoc()) {
                        echo "<option value='" . $section['section_id'] . "'>" . htmlspecialchars($section['section_name']) . "</option>";
                    }
                    ?>
                </select>
                <input type="text" name="title" class="title" placeholder="ADD Task Title" required>
                <input type="datetime-local" class="form-control" name="due_date" placeholder="Due date"required><br> 
                <button class="create-task-btn">Create Task</button>
            </form>
        </div>
    </div>

    <!-- Update Task Box -->
    <div class="update-task-box" id="update-task-box">
        <div class="Closing-tab">
            <button data-close-button class="close-button">&times;</button>
        </div>
        <div class="SectionTitle">
            <label id="section" class="section"></label><br> 
        </div>
        <div class="Input">
            <form action="update_task.php" method="POST">
                <input type="hidden" name="update_task_id">
                <input type="hidden" name="update_section_id">
                <input type="text" name="update_title" class="title" required>
                <input type="datetime-local" class="form-control" name="update_due_date" required><br> 
                <button type="submit" class="update-task-btn">Update Task</button>
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
    <div class="container">
        <div class="allTasks" id="allTasks">
            <?php
            // Fetch task sections (lists)
            $sql_sections = "SELECT * FROM task_sections";
            $result_sections = $conn->query($sql_sections);

            if ($result_sections && $result_sections->num_rows > 0) {
                while ($section = $result_sections->fetch_assoc()) {
                    echo '<div class="task-section">'; 
                    echo '<form method="POST" action="operation.php">';
                    echo '<input type="hidden" name="delete_section_id" value="' . $section['section_id'] . '">';
                    echo '<button type="submit" class="close-button">&times;</button>';
                    echo '</form>';
                    echo "<strong>" . htmlspecialchars($section['section_name']) . "</strong>";
                    
                    // Fetch tasks for this section
                    $section_id = $section['section_id'];
                    $sql_tasks = "SELECT * FROM tasks WHERE section_id = $section_id";
                    $result_tasks = $conn->query($sql_tasks);

                    if ($result_tasks->num_rows > 0) {
                        echo '<form method="POST" action="operation.php">'; 
                        echo "<ul>";
                        while ($task = $result_tasks->fetch_assoc()) {
                            $due_date = date("F j, Y, g:i a", strtotime($task['due_date']));
                            echo 
                            "<li>" .
                                '<div class="taskContainer">'.
                                    '<div class="taskDiv">'.
                                        '<input type="radio" id="'.$task['task_id'].'" name="selected_task" value="'.$task['task_id'].'" '.($task['status'] === 'completed' ? 'disabled' : '').' onchange="this.form.submit()">'.
                                        '<label for="'.$task['task_id'].'">' . htmlspecialchars($task['title']) . '</label>'.
                                    '</div>'.
                                    '<div class="taskDivSpan">'.
                                        '<span class="task-status"> (' . htmlspecialchars($task['status']) . ')</span>'.
                                        '<span class="due-date"> (Due: ' . htmlspecialchars($due_date) . ')</span>'.
                                    '</div>'.
                                    '<div class="dropDown">'.
                                        '<input type="checkbox" id="toggle-'.$task['task_id'].'" class="dropdown-toggle">'.
                                        '<label for="toggle-'.$task['task_id'].'" class="dropDownButton">⋮</label>'.
                                        '<div class="optionsDropDown">'.
                                            '<input type="hidden" name="task_id" value="'.$task['task_id'].'">'.
                                            '<button type="button" class="action-btn" data-section-title="'.$section['section_name'].'" data-section-id="'.$task['section_id'].'" data-task-id="'.$task['task_id'].'" data-task-title="'.htmlspecialchars($task['title']).'" data-task-due="'.$due_date.'" data-task-target="#update-task-box">Update</button>'.
                                            '<button type="submit" class="action-btn" name="action" value="delete">Delete</button>'.
                                        '</div>'.
                                    '</div>'.
                                '</div>'.
                            "</li>";
                        }
                        echo "</ul></form>";
                    }                     

                    echo '</div>';  
                }
            } else {
                echo "<p>No lists found.</p>";
            }
            ?>
        </div>
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
