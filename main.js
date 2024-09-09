const hamBurger = document.querySelector('.hamburger');
const offScreenMenu = document.querySelector('.off-screen-menu');
const allTasks = document.querySelector('.allTasks');
const openTaskBox = document.querySelectorAll('[data-task-target]');
const closeTaskBtn = document.querySelectorAll('[data-close-button]');
const overlay = document.getElementById('overlay');

hamBurger.addEventListener('click', () => {
    hamBurger.classList.toggle('active');
    offScreenMenu.classList.toggle('active');
    allTasks.classList.toggle('menu-active');
});

openTaskBox.forEach(button => {
    button.addEventListener('click', () => {
        const task = document.querySelector(button.dataset.taskTarget);
        openTask(task);
    });
});

closeTaskBtn.forEach(button => {
    button.addEventListener('click', () => {
        const task = button.closest('.create-task-box');
        closeTask(task);
    });
});

function openTask(task) {
    if (task == null) return;
    task.classList.add('active');
    overlay.classList.add('active');
}

function closeTask(task) {
    if (task == null) return;
    task.classList.remove('active');
    overlay.classList.remove('active');
}
