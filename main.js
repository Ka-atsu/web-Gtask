document.addEventListener('DOMContentLoaded', () => {
    const hamBurger = document.querySelector('.hamburger');
    const offScreenMenu = document.querySelector('.off-screen-menu');
    const allTasks = document.querySelector('.allTasks');
    const navbar = document.querySelector('.navbar');
    const openTaskBox = document.querySelectorAll('[data-task-target]');
    const closeTaskBtn = document.querySelectorAll('[data-close-button]');
    const overlay = document.getElementById('overlay');
    const taskListDropdownBtn = document.getElementById('list-tasks');
    const taskList = document.getElementById('task-list'); 

    // Hamburger Menu Toggle
    hamBurger.addEventListener('click', () => {
        hamBurger.classList.toggle('active');
        offScreenMenu.classList.toggle('active');
        allTasks.classList.toggle('menu-active');
        navbar.classList.toggle('menu-active');
    });

    // Open task box functionality
    openTaskBox.forEach(button => {
        button.addEventListener('click', () => {
            const task = document.querySelector(button.dataset.taskTarget);
            openTask(task);
            
           // Populate the update task box if it's the update button
           if (button.classList.contains('action-btn')) {
            const taskId = button.getAttribute('data-task-id');
            const sectionId = button.getAttribute('data-section-id');
            const taskTitle = button.getAttribute('data-task-title');
            const sectionTitle = button.getAttribute('data-section-title');
            const taskDue = button.getAttribute('data-task-due');

            // Populate fields

            const taskIdInput = task.querySelector('input[name="update_task_id"]');
            const sectionIdInput = task.querySelector('input[name="update_section_id"');
            const titleInput = task.querySelector('input[name="update_title"]');
            const dueDateInput = task.querySelector('input[name="update_due_date"]');
            
            taskIdInput.value = taskId;
            sectionIdInput.value = sectionId;
            titleInput.value = taskTitle;
            dueDateInput.value = taskDue;
            
            
            document.getElementById('section').innerHTML = sectionTitle;

            // Set the section ID if needed (you might need to adjust this based on your logic)
           }
        });
    });

    // Close task box functionality
    closeTaskBtn.forEach(button => {
        button.addEventListener('click', () => {
            const task = button.closest('.create-task-box') || button.closest('.create-list-box') || button.closest('.update-task-box');
            closeTask(task);
        });
    });

    // Function to open a task box
    function openTask(task) {
        if (task == null) {
            console.log("No action specified."); // Debugging message
            return;
        }
        task.classList.add('active');
        overlay.classList.add('active');
    }

    // Function to close a task box
    function closeTask(task) {
        if (task == null) return;
        task.classList.remove('active');
        overlay.classList.remove('active');
    }

    // Dropdown toggle for "List of Tasks"
    taskListDropdownBtn.addEventListener('click', () => {
        taskList.classList.toggle('visible'); // Toggle visibility
        // Change the button text to indicate if it's open or closed
        taskListDropdownBtn.textContent = taskList.classList.contains('visible') 
            ? 'List of Tasks ▲' 
            : 'List of Tasks ▼';
    });
});
