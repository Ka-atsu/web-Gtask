const hamBurger = document.querySelector('.hamburger');
const offScreenMenu = document.querySelector('.off-screen-menu');
const allTasks = document.querySelector('.allTasks');
const openTaskBox = document.querySelectorAll('[data-task-target]');
const closeTaskBtn = document.querySelectorAll('[data-close-button]');
const overlay = document.getElementById('overlay');
const taskListDropdownBtn = document.getElementById('list-tasks');
const taskList = document.getElementById('task-list'); // Task list container

// Hamburger Menu Toggle
hamBurger.addEventListener('click', () => {
    hamBurger.classList.toggle('active');
    offScreenMenu.classList.toggle('active');
    allTasks.classList.toggle('menu-active');
});

// Open task box functionality
openTaskBox.forEach(button => {
    button.addEventListener('click', () => {
        const task = document.querySelector(button.dataset.taskTarget);
        openTask(task);
    });
});

// Close task box functionality
closeTaskBtn.forEach(button => {
    button.addEventListener('click', () => {
        const task = button.closest('.create-task-box');
        closeTask(task);
    });
});

// Function to open a task box
function openTask(task) {
    if (task == null) return;
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
