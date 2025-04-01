document.addEventListener("DOMContentLoaded", function () {
  const deleteAccountForm = document.getElementById(
    "profile-delete-account-form"
  );

  if (deleteAccountForm) {
    deleteAccountForm.addEventListener("submit", function (e) {
      e.preventDefault();

      const password = document.getElementById("deletePassword").value;
      const confirmText = document.getElementById("deleteConfirm").value;

      // Validate password
      if (!password) {
        Swal.fire({
          title: "Error",
          text: "Please enter your current password",
          icon: "error",
          confirmButtonColor: "#dc3545",
        });
        return;
      }

      // Validate confirmation text
      if (confirmText !== "DELETE") {
        Swal.fire({
          title: "Error",
          text: 'Please type "DELETE" to confirm account deletion',
          icon: "error",
          confirmButtonColor: "#dc3545",
        });
        return;
      }

      // Show confirmation dialog
      Swal.fire({
        title: "Are you absolutely sure?",
        text: "This action cannot be undone! All your data will be permanently deleted.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#dc3545",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Yes, delete my account",
        cancelButtonText: "Cancel",
      }).then((result) => {
        if (result.isConfirmed) {
          // Show loading state
          Swal.fire({
            title: "Deleting Account",
            text: "Please wait while we process your request...",
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            willOpen: () => {
              Swal.showLoading();
            },
          });

          // Send delete request
          fetch("../config/delete-account.php", {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              password: password,
            }),
          })
            .then((response) => {
              if (!response.ok) {
                throw new Error("Network response was not ok");
              }
              return response.json();
            })
            .then((data) => {
              if (data.status === "success") {
                Swal.fire({
                  title: "Account Deleted!",
                  text: "Your account has been successfully deleted. You will be redirected to the login page.",
                  icon: "success",
                  confirmButtonColor: "#198754",
                  allowOutsideClick: false,
                  allowEscapeKey: false,
                }).then(() => {
                  // Redirect to login page
                  window.location.href = "../views/login.php";
                });
              } else {
                Swal.fire({
                  title: "Error",
                  text:
                    data.message ||
                    "Failed to delete account. Please try again.",
                  icon: "error",
                  confirmButtonColor: "#dc3545",
                });
              }
            })
            .catch((error) => {
              console.error("Error:", error);
              Swal.fire({
                title: "Error",
                text: "An error occurred while deleting your account. Please try again later.",
                icon: "error",
                confirmButtonColor: "#dc3545",
              });
            });
        }
      });
    });
  }
});
