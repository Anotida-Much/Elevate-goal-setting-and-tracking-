document.addEventListener("DOMContentLoaded", () => {
  const endpoint = "../config/account-settings.php";

  // Fetch user data and prefill the form
  async function fetchUserData() {
    try {
      const response = await fetch(endpoint, { method: "GET" });
      if (!response.ok) throw new Error("Failed to fetch user data");

      const data = await response.json();
      if (data.status === "success") {
        // Prefill the form fields with user data
        document.getElementById("full_name").value = data.data.full_name;
        document.getElementById("user_name").value = data.data.username;
        document.getElementById("user_country").value = data.data.country;
        document.getElementById("user_email").value = data.data.email;
      } else {
        console.error(data.message);
      }
    } catch (error) {
      console.error("Error fetching user data:", error);
    }
  }

  // Update user data
  async function updateUserData(event) {
    event.preventDefault();

    const fullName = document.getElementById("full_name").value;
    const username = document.getElementById("user_name").value;
    const country = document.getElementById("user_country").value;
    const email = document.getElementById("user_email").value;

    try {
      const response = await fetch(endpoint, {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ fullName, username, country, email }),
      });

      const data = await response.json();
      if (data.status === "success") {
        alert(data.message);
      } else {
        console.error(data.message);
      }
    } catch (error) {
      console.error("Error updating user data:", error);
    }
  }

  // Delete account
  async function deleteAccount() {
    if (confirm("Are you sure you want to delete your account?")) {
      try {
        const response = await fetch(endpoint, { method: "DELETE" });
        const data = await response.json();
        if (data.status === "success") {
          alert(data.message);
          window.location.href = "../views/login.php";
        } else {
          console.error(data.message);
        }
      } catch (error) {
        console.error("Error deleting account:", error);
      }
    }
  }

  // Add event listener to the "Save Changes" button
  document
    .getElementById("profile-edit-form")
    .addEventListener("submit", updateUserData);

  // Fetch user data on page load
  fetchUserData();
});
