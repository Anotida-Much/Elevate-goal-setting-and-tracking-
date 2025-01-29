function showTime() {
  const currentTime = new Date();
  const hours = currentTime.getHours().toString().padStart(2, "0");
  const minutes = currentTime.getMinutes().toString().padStart(2, "0");
  const seconds = currentTime.getSeconds().toString().padStart(2, "0");

  document.getElementById("live-clock").innerHTML = `${hours}:${minutes}:${seconds}`;
}

setInterval(showTime, 1000); // Update every 1 second
