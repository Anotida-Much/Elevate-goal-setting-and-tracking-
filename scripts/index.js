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
  const { MISSED, COMPLETED, IN_PROGRESS, ON_HOLD } = data;
  const totalGoals = MISSED + COMPLETED + IN_PROGRESS + ON_HOLD;

  const elements = {
    "goals-set": totalGoals,
    "goals-missed": MISSED,
    "goals-achieved": COMPLETED,
    "goals-in-progress": IN_PROGRESS,
    "goals-on-hold": ON_HOLD,
  };

  for (const [id, value] of Object.entries(elements)) {
    const element = document.getElementById(id);
    if (element) {
      element.textContent = value;
    }
  }
}
