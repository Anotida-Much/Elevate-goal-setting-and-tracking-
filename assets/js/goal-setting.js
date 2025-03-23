document.addEventListener("DOMContentLoaded", () => {
  const addTaskBtn = document.getElementById("add-task-btn");
  const tasksList = document.getElementById("tasks-list");
  const newTaskInput = document.getElementById("new-task");
  const tasksInput = document.getElementById("tasks");

  let tasks = [];

  addTaskBtn.addEventListener("click", addTask);
  newTaskInput.addEventListener("keypress", (e) => {
    if (e.key === "Enter") addTask();
  });

  function addTask() {
    const taskText = newTaskInput.value.trim();
    if (taskText) {
      tasks.push(taskText);
      renderTasks();
      newTaskInput.value = "";
    }
  }

  function renderTasks() {
    tasksList.innerHTML = tasks
      .map(
        (task, index) => `
        <li>
          ${task} 
          <button class="btn btn-sm btn-danger" data-index="${index}">Remove</button>
        </li>
      `
      )
      .join("");
    tasksInput.value = JSON.stringify(tasks);
    tasksList.querySelectorAll("button").forEach((button) => {
      button.addEventListener("click", () => removeTask(button.dataset.index));
    });
  }

  function removeTask(index) {
    tasks.splice(index, 1);
    renderTasks();
  }
});
