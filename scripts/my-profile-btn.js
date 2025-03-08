document.addEventListener("DOMContentLoaded", () => {
  const fetchUserProfile = async () => {
    try {
      const response = await fetch("./config/account-settings.php", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      });
      const data = await response.json();
      if (data.status === "success") {
        populateUserProfile(data.data);
      } else {
        window.showToast(data.message);
      }
    } catch (error) {
      window.showToast(
        "Sorry, an error occurred while retrieving your information. Try logging in again."
      );
    }
  };

  const populateUserProfile = (userData) => {
    const profileFields = [
      { id: "fullname", value: userData.full_name },
      { id: "username", value: userData.username },
      { id: "full-name", value: userData.full_name },
      { id: "user-name", value: userData.username },
      { id: "country", value: userData.country },
      { id: "email", value: userData.email },
      { id: "full_name", value: userData.full_name, isInput: true },
      { id: "user_name", value: userData.username, isInput: true },
      { id: "user_country", value: userData.country, isInput: true },
      { id: "user_email", value: userData.email, isInput: true },
    ];

    profileFields.forEach((field) => {
      const element = document.getElementById(field.id);
      if (element) {
        if (field.isInput) {
          element.value = field.value;
        } else {
          element.textContent = field.value;
        }
      }
    });
  };

  const handleProfileEditSubmit = async (event) => {
    event.preventDefault();

    const fullName = document.getElementById("full_name").value;
    const username = document.getElementById("user_name").value;
    const country = document.getElementById("user_country").value;
    const email = document.getElementById("user_email").value;

    try {
      const response = await fetch("./config/account-settings.php", {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ fullName, username, country, email }),
      });
      const data = await response.json();
      window.showToast(data.message);
    } catch (error) {
      window.showToast("Error occurred while updating your profile.");
    }
  };

  fetchUserProfile();

  const editProfileForm = document.querySelector("#profile-edit form");
  if (editProfileForm) {
    editProfileForm.addEventListener("submit", handleProfileEditSubmit);
  }
});
