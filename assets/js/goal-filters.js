// Search functionality
const searchInput = document.querySelector('input[name="query"]');
const goalArticles = document.querySelectorAll("#goals-container article");

searchInput.addEventListener("input", (e) => {
  const searchTerm = e.target.value.toLowerCase();

  goalArticles.forEach((article) => {
    const title = article
      .querySelector(".card-title")
      .textContent.toLowerCase();
    const description = article
      .querySelector(".card-text")
      .textContent.toLowerCase();
    const category = article
      .querySelector(".card-footer .col:first-child span")
      .textContent.toLowerCase();

    if (
      title.includes(searchTerm) ||
      description.includes(searchTerm) ||
      category.includes(searchTerm)
    ) {
      article.style.display = "";
    } else {
      article.style.display = "none";
    }
  });
});

// Filter functionality
const filterButtons = document.querySelectorAll(".filter-btn");

filterButtons.forEach((button) => {
  button.addEventListener("click", (e) => {
    e.preventDefault();
    const filter = e.target.dataset.filter;

    // Update the dropdown button text
    const dropdownButton = document.getElementById("filterDropdown");
    dropdownButton.textContent = e.target.textContent;

    goalArticles.forEach((article) => {
      const status = article
        .querySelector("#goal-status .badge")
        .textContent.trim()
        .toLowerCase();
      const statusClass = status.replace(/\s+/g, "-");

      if (filter === "*" || filter === `.${statusClass}`) {
        article.style.display = "";
      } else {
        article.style.display = "none";
      }
    });
  });
});

// Sort functionality
const sortButtons = document.querySelectorAll(".sort-btn");
const goalsContainer = document.getElementById("goals-container");

sortButtons.forEach((button) => {
  button.addEventListener("click", (e) => {
    e.preventDefault();
    const sortBy = e.target.dataset.sort;

    // Update the dropdown button text
    const dropdownButton = document.getElementById("sortDropdown");
    dropdownButton.textContent = e.target.textContent;

    const articles = Array.from(goalArticles);

    articles.sort((a, b) => {
      switch (sortBy) {
        case "due-date":
          return compareDates(
            a
              .querySelector(".card-footer .col:nth-child(2) span")
              .textContent.replace("Due Date: ", ""),
            b
              .querySelector(".card-footer .col:nth-child(2) span")
              .textContent.replace("Due Date: ", "")
          );
        case "progress":
          return compareProgress(a, b);
        case "start-date":
          return compareDates(
            a
              .querySelector(".card-footer .col:nth-child(2) span")
              .textContent.replace("Starting Date: ", ""),
            b
              .querySelector(".card-footer .col:nth-child(2) span")
              .textContent.replace("Starting Date: ", "")
          );
        default:
          return 0;
      }
    });

    // Clear and reorder the articles in the DOM
    articles.forEach((article) => goalsContainer.appendChild(article));
  });
});

// Helper functions
function compareDates(dateA, dateB) {
  return new Date(dateA) - new Date(dateB);
}

function compareProgress(a, b) {
  const progressA = parseInt(a.querySelector(".progress-bar").style.width) || 0;
  const progressB = parseInt(b.querySelector(".progress-bar").style.width) || 0;
  return progressB - progressA; // Sort in descending order
}
