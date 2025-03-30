document.addEventListener("DOMContentLoaded", () => {
  const deleteAccountBtn = document.getElementById("deleteAccountBtn");
  const endpoint = "../config/account-settings.php";

  // Handle Delete Account button click
  if (deleteAccountBtn) {
    deleteAccountBtn.addEventListener("click", async (event) => {
      event.preventDefault(); // Prevent the default link behavior

      const confirmed = await showConfirmDialog(
        "Are you sure you want to delete your account? This action cannot be undone."
      );

      if (confirmed) {
        try {
          const response = await fetch(endpoint, {
            method: "DELETE",
            headers: {
              "Content-Type": "application/json",
            },
          });

          const data = await response.json();

          if (data.status === "success") {
            showSuccess(data.message);
            // Redirect to the login page after successful deletion
            window.location.href = "../views/login.php";
          } else {
            console.error(data.message);
            showError(data.message || "Error deleting account");
          }
        } catch (error) {
          console.error("Error deleting account:", error);
          showError("An error occurred while deleting your account");
        }
      }
    });
  }
});
