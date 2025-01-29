document.addEventListener("DOMContentLoaded", () => {
  // My Profile Button
  fetch("./config/account-settings.php", {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    },
  })
    .then((response) => response.json())
    .then((data) => {
      if (data.status === "success") {
        const userData = data.data;
        // Displaying user profile
        document.getElementById("fullname").textContent = userData.full_name;
        document.getElementById("username").textContent = userData.username;

        // Display user profile overview
        document.getElementById("full-name").textContent = userData.full_name;
        document.getElementById("user-name").textContent = userData.username;
        document.getElementById("country").textContent = userData.country;
        document.getElementById("email").textContent = userData.email;

        //   Set placeholders for edit profile section
        document.getElementById("full_name").value = userData.full_name;
        document.getElementById("user_name").value = userData.username;
        document.getElementById("user_country").value = userData.country;
        document.getElementById("user_email").value = userData.email;
      } else {
        window.showToast(data.message);
      }
    })
    .catch((error) => {
      window.showToast(
        "Sorry, an error occured while retrieving your information. Try logging in again...."
      );
    });

  // save changes
  const editProfileForm = document.querySelector("#profile-edit form");

  editProfileForm.addEventListener("submit", (e) => {
    e.preventDefault();

    const fullName = document.getElementById("full_name").value;
    const username = document.getElementById("user_name").value;
    const country = document.getElementById("user_country").value;
    const email = document.getElementById("user_email").value;

    // Send PUT request to update user data
    fetch("./config/account-settings.php", {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        fullName,
        username,
        country,
        email,
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.status === "success") {
          // Display success message
          window.showToast(data.message);
        } else {
          // Display error message
          window.showToast(data.message);
        }
      })
      .catch((error) => {
        window.showToast("Error occurred while updating your profile:");
      });
  });
});