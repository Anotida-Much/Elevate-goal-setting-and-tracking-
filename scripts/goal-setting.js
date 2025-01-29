const addTaskBtn = document.getElementById("add-task-btn");
const tasksList = document.getElementById("tasks-list");
const newTaskInput = document.getElementById("new-task");
const tasksInput = document.getElementById("tasks");

let tasks = [];

addTaskBtn.addEventListener("click", addTask);

function addTask() {
  const taskText = newTaskInput.value.trim();
  if (taskText) {
    tasks.push(taskText);
    renderTasks();
    newTaskInput.value = "";
  }
}

function renderTasks() {
  tasksList.innerHTML = "";
  tasks.forEach((task, index) => {
    const taskElement = document.createElement("li");
    taskElement.textContent = task;
    taskElement.innerHTML += ` <button class="btn btn-sm btn-danger" onclick="removeTask(${index})">Remove</button>`;
    tasksList.appendChild(taskElement);
  });
  tasksInput.value = JSON.stringify(tasks);
}

function removeTask(index) {
  tasks.splice(index, 1);
  renderTasks();
}
