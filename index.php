<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yes</title>
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
            <li><button data-task-target="#create-task-box">Create</button></li>
            <li><a href="#" id="all-tasks-link">All Tasks (<span id="task-count">0</span>)</a></li>
            <li><a href="#">Starred</a></li>
            <li><a href="#" id="list-tasks" class="dropdown-btn">List of Tasks ▼</a>
                <ul class="task-list" id="task-list">
                <h1>My Tasks</h1>
                </ul>
            </li>
            <li><a href="#create-list-box" id="create-new-list">Create new list +</a>
        </ul>
    </div>

      <!-- Create Task Box -->
    <div class="create-task-box" id="create-task-box">
        <div class="Closing-tab">
            <button data-close-button class="close-button">&times;</button>
        </div>
        <div class="Input">
            <form action="submit_task.php" method="POST">
                <input type="text" name="title" class="title" placeholder="ADD Task Title">
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
            <input type="text" name="title" class="title" placeholder="Name">
            <button class="create-task-btn">DONE</button>
        </div>
    </div>

    <div id="overlay"></div>

    <nav class="navbar">
        <h1>TASK</h1>
        <div class="hamburger" id="hamburger">
            <div class="hamburger-content">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </nav>

    <div class="allTasks" id="allTasks">
    <ul>
        <h1>My Tasks</h1>
        <li><button id="add-task-btn" data-task-target="#create-task-box">Add a task</button></li>
        <?php include 'fetch_tasks.php'; ?>
    </ul>
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
