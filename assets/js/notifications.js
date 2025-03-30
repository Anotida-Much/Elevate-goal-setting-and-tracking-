// Function to show notifications using SweetAlert2
function showNotification(message, type = "success") {
  const Toast = Swal.mixin({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener("mouseenter", Swal.stopTimer);
      toast.addEventListener("mouseleave", Swal.resumeTimer);
    },
  });

  Toast.fire({
    icon: type,
    title: message,
  });
}

// Function to show confirmation dialog
async function showConfirmDialog(message) {
  const result = await Swal.fire({
    title: "Are you sure?",
    text: message,
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes",
    cancelButtonText: "No",
  });

  return result.isConfirmed;
}

// Function to show error notification
function showError(message) {
  Swal.fire({
    icon: "error",
    title: "Error",
    text: message,
  });
}

// Function to show success notification
function showSuccess(message) {
  Swal.fire({
    icon: "success",
    title: "Success",
    text: message,
  });
}

// Make functions globally accessible
window.showNotification = showNotification;
window.showConfirmDialog = showConfirmDialog;
window.showError = showError;
window.showSuccess = showSuccess;
window.showToast = (message) => showNotification(message);
