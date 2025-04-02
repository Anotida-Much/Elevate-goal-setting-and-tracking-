// Set the idle timeout (10 minutes)
const timeout = 10 * 60 * 1000;
let timer = setTimeout(logoutUser, timeout);

document.getElementById("logoutBtn").addEventListener("click", logoutUser);

document.addEventListener("mousemove", resetTimer);
document.addEventListener("keydown", resetTimer);
document.addEventListener("scroll", resetTimer);
document.addEventListener("click", resetTimer);

function resetTimer() {
  clearTimeout(timer);
  timer = setTimeout(logoutUser, timeout);
}

async function logoutUser() {
  try {
    const response = await fetch("../config/logout.php");
    if (response.ok) {
      window.location.href = "../index.php";
    } else {
      console.error("Failed to log out user:", response.status);
    }
  } catch (error) {
    showError("Error logging out user:");
  }
}
