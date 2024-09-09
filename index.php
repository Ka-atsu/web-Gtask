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
    </style>
</head>
    <body>
            
        <div class="off-screen-menu" id="off-screen-menu">
            <ul class="nav-links">
                <li><button data-task-target="#create-task-box">Create</button></li>
                <li><a href="#">All Tasks</a></li>
                <li><a href="#">Starred</a></li>
            </ul>
        </div>

        <div class="create-task-box" id="create-task-box">
            <div class="Closing-tab">
                <button data-close-button class="close-button">&times;</button>
            </div>
            <div class="Input">
                <input type="text" name="title" class="title">
                <label class="placeHolder">Add Title</label>
                <input type="datetime-local" class="form-control" placeholder="Select DateTime" style="color: white;">
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
                <li><button>Add a task</button></li>
            </ul>
        </div>

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="main.js"></script>
        <script>
            config ={
                enableTime:true,
                dateFormat: "Y-m-d H:i",
            }
        flatpickr("input[type=datetime-local]", config);
        </script>

    </body>
</html>
