function displayAlert(message, type = "success", duration = 3000) {
  const alertContainer = document.createElement("div");
  alertContainer.className = `alert alert-${type} alert-dismissible fade`;
  alertContainer.setAttribute("role", "alert");

  const alertMessage = document.createElement("span");
  alertMessage.textContent = message;
  alertContainer.appendChild(alertMessage);

  const closeBtn = document.createElement("button");
  closeBtn.type = "button";
  closeBtn.className = "close";
  closeBtn.innerHTML = "&times;";
  let timeoutId = setTimeout(() => alertContainer.remove(), duration);

  closeBtn.addEventListener("click", () => {
    clearTimeout(timeoutId);
    alertContainer.remove();
  });
  alertContainer.appendChild(closeBtn);

  document.body.appendChild(alertContainer);
  setTimeout(() => alertContainer.remove(), duration);
}

export default displayAlert;
