function showTime() {
  const currentTime = new Date();
  const formatTimeUnit = (unit) => unit.toString().padStart(2, "0");

  const hours = formatTimeUnit(currentTime.getHours());
  const minutes = formatTimeUnit(currentTime.getMinutes());
  const seconds = formatTimeUnit(currentTime.getSeconds());

  document.getElementById(
    "live-clock"
  ).textContent = `${hours}:${minutes}:${seconds}`;
}

document.addEventListener("DOMContentLoaded", () => {
  showTime(); // Initial call to display the time immediately
  setInterval(showTime, 1000); // Update every 1 second
});
