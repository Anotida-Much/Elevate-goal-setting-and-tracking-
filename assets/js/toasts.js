// Function to show toast notification
function showToast(message) {
  const toast = document.createElement("div");
  toast.className = "toast";
  toast.innerHTML = `
    <div class="toast-header bg-info justify-content-between">
      <strong class="mr-auto">Notification</strong>
      <button type="button" class="close border-none" onclick="this.parentNode.remove()">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      <div>${message}</div>
    </div>
  `;

  document.body.appendChild(toast);
  toast.classList.add("show");
  setTimeout(() => toast.remove(), 7000);
}

// Make the function globally accessible
window.showToast = showToast;
