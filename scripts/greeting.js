document.addEventListener("DOMContentLoaded", function () {
  // Get the username from a data attribute in the HTML
  const username = document.getElementById("username").dataset.username;
  const hour = new Date().getHours();
  let greeting = "Hello!"; // Default greeting

  if (hour >= 1 && hour < 12) {
    greeting = `<span class="lead fs-5 gradient-text"> Good morning ${username}</span>`;
  } else if (hour >= 12 && hour < 18) {
    greeting = `<span class="lead fs-5 gradient-text"> Good afternoon ${username}</span>`;
  } else {
    greeting = `<span class="lead fs-5 gradient-text"> Good evening ${username}</span>`;
  }

  const typed = new Typed("#typed", {
    strings: [greeting],
    typeSpeed: 30,
    showCursor: false,
  });
});
