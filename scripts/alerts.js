function displayAlert(message, type = "success", duration = 3000) {
  const alertContainer = document.createElement("div");
  alertContainer.className = `alert alert-${type} alert-dismissible fade`;
  alertContainer.role = "alert";

  const alertMessage = document.createElement("span");
  alertMessage.textContent = message;
  alertContainer.appendChild(alertMessage);

  const closeBtn = document.createElement("button");
  closeBtn.type = "button";
  closeBtn.className = "close";
  closeBtn.innerHTML = '<span aria-hidden="true">&times;</span>';
  closeBtn.addEventListener("click", () => alertContainer.remove());
  alertContainer.appendChild(closeBtn);

  document.body.appendChild(alertContainer);

  setTimeout(() => alertContainer.remove(), duration);
}

export default displayAlert;
