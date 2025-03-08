document.addEventListener("DOMContentLoaded", () => {
  const usernameElement = document.getElementById("username");
  if (!usernameElement) {
    console.error("Username element not found");
    return;
  }

  const username = usernameElement.dataset.username;
  const hour = new Date().getHours();
  let greeting;

  if (hour >= 1 && hour < 12) {
    greeting = `Good morning ${username}`;
  } else if (hour >= 12 && hour < 18) {
    greeting = `Good afternoon ${username}`;
  } else {
    greeting = `Good evening ${username}`;
  }

  const greetingHtml = `<span class="lead fs-5 gradient-text">${greeting}</span>`;

  new Typed("#typed", {
    strings: [greetingHtml],
    typeSpeed: 30,
    showCursor: false,
  });
});
