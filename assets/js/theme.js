// Get the theme toggle button
const themeToggleButton = document.getElementById("theme-toggle");

// Check if user has already set a theme preference
if (localStorage.getItem("theme") === "dark") {
  document.body.classList.add("dark-background");
  document.body.classList.remove("light-background");
  themeToggleButton.checked = true;
} else {
  document.body.classList.add("light-background");
  document.body.classList.remove("dark-background");
}

// Add an event listener to the theme toggle button
themeToggleButton.addEventListener("change", () => {
  // Toggle the theme
  if (themeToggleButton.checked) {
    document.body.classList.add("dark-background");
    document.body.classList.remove("light-background");
    localStorage.setItem("theme", "dark");
  } else {
    document.body.classList.add("light-background");
    document.body.classList.remove("dark-background");
    localStorage.setItem("theme", "light");
  }
});
