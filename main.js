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

// Show and hide the create-task-box
const createTaskBtn = document.querySelector('[data-task-target="#create-task-box"]');
const createTaskBox = document.getElementById('create-task-box');
const closeTaskBoxBtn = createTaskBox.querySelector('[data-close-button]');

createTaskBtn.addEventListener('click', () => {
    createTaskBox.classList.add('active');
    overlay.classList.add('active');
});

closeTaskBoxBtn.addEventListener('click', () => {
    createTaskBox.classList.remove('active');
    overlay.classList.remove('active');
});

// Show and hide the create-list-box when "Create new list" is clicked
const createNewListBtn = document.getElementById('create-new-list');
const createListBox = document.getElementById('create-list-box');
const closeListBoxBtn = createListBox.querySelector('[data-close-button]');

createNewListBtn.addEventListener('click', () => {
    createListBox.classList.add('active');
    overlay.classList.add('active');
});

closeListBoxBtn.addEventListener('click', () => {
    createListBox.classList.remove('active');
    overlay.classList.remove('active');
});

overlay.addEventListener('click', () => {
    createTaskBox.classList.remove('active');
    createListBox.classList.remove('active');
    overlay.classList.remove('active');
});