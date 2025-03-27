// Search functionality
const searchInput = document.querySelector('input[name="query"]');
const goalArticles = document.querySelectorAll("article.card");

searchInput.addEventListener("input", (e) => {
  const searchTerm = e.target.value.toLowerCase();

  goalArticles.forEach((article) => {
    const title = article
      .querySelector("#card-title")
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

      // Convert status to class name format
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
const sortButtons = document.querySelectorAll(
  "#sortDropdown + .dropdown-menu .dropdown-item"
);

sortButtons.forEach((button) => {
  button.addEventListener("click", (e) => {
    e.preventDefault();
    const sortBy = e.target.textContent.trim();

    // Update the dropdown button text
    const dropdownButton = document.getElementById("sortDropdown");
    dropdownButton.textContent = sortBy;

    const container = document.querySelector(".col-md-10");
    const articles = Array.from(goalArticles);

    articles.sort((a, b) => {
      switch (sortBy) {
        case "Due Date":
          return compareDates(
            a
              .querySelector(".card-footer .col:nth-child(2) span")
              .textContent.replace("Due Date: ", ""),
            b
              .querySelector(".card-footer .col:nth-child(2) span")
              .textContent.replace("Due Date: ", "")
          );
        case "Progress":
          return compareProgress(a, b);
        case "Starting Date":
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
    container.innerHTML = "";
    articles.forEach((article) => container.appendChild(article));
  });
});

// Helper functions
function getStatusClass(status) {
  return status.toLowerCase().replace(/\s+/g, "-");
}

function compareDates(dateA, dateB) {
  return new Date(dateA) - new Date(dateB);
}

function compareProgress(a, b) {
  const progressA = parseInt(a.querySelector(".progress-bar").style.width) || 0;
  const progressB = parseInt(b.querySelector(".progress-bar").style.width) || 0;
  return progressB - progressA; // Sort in descending order
}
