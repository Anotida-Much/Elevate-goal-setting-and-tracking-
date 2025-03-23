document.addEventListener("DOMContentLoaded", () => {
  const deleteAccountBtn = document.getElementById("deleteAccountBtn");
  console.log(deleteAccountBtn);
  const endpoint = "../config/account-settings.php";

  // Handle Delete Account button click
  if (deleteAccountBtn) {
    deleteAccountBtn.addEventListener("click", async () => {
      if (
        confirm(
          "Are you sure you want to delete your account? This action cannot be undone."
        )
      ) {
        try {
          const response = await fetch(endpoint, { method: "DELETE" });
          const data = await response.json();

          if (data.status === "success") {
            window.showToast(data.message);
            // Redirect to the login page after successful deletion
            window.location.href = "../views/login.php";
          } else {
            console.error(data.message);
            alert("Error: " + data.message);
          }
        } catch (error) {
          console.error("Error deleting account:", error);
          window.showToast(data.message);
        }
      }
    });
  }
});
