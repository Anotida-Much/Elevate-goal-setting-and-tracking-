document.addEventListener("DOMContentLoaded", async () => {
  const fetchConfig = {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
  };

  try {
    const response = await fetch(
      "./config/analysis/pie-chart.php",
      fetchConfig
    );

    if (!response.ok) {
      throw new Error("Network error");
    }
    const data = await response.json();

    updateHtmlElementsWithStatistics(data);
  } catch (error) {
    console.error("Error:", error);
  }
});

// Home page statistics
function updateHtmlElementsWithStatistics(data) {
  const total_goals =
    data.MISSED + data.COMPLETED + data.IN_PROGRESS + data.ON_HOLD;
  document.getElementById("goals-set").textContent = total_goals;
  document.getElementById("goals-missed").textContent = data.MISSED;
  document.getElementById("goals-achieved").textContent = data.COMPLETED;
  document.getElementById("goals-in-progress").textContent = data.IN_PROGRESS;
  document.getElementById("goals-on-hold").textContent = data.ON_HOLD;
}

// -------------------------------------------------------------------------------------------------------------

