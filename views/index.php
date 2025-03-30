<?php
// Check if user is logged in
require_once '../config/auth.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Elevate: Your ultimate goal setting and tracking web app to help you achieve your aspirations and maximum potential.">
  <meta name="keywords" content="goal setting, goal tracking, productivity, personal development, Elevate">
  <meta name="author" content="Anotida Muchinhairi">

  <link rel="shortcut icon" href="/Elevate/assets/img/logo.jpg" type="image/x-icon">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="/Elevate/node_modules/bootstrap/dist/css/bootstrap.min.css" />
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="/Elevate/node_modules/bootstrap-icons/font/bootstrap-icons.css" />
  <!-- Quill CSS -->
  <link rel="stylesheet" href="/Elevate/node_modules/quill/dist/quill.snow.css">
  <!-- AOS CSS -->
  <link rel="stylesheet" href="/Elevate/node_modules/aos/dist/aos.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="/Elevate/assets/css/main.css" />
  <!-- SweetAlert2 CSS -->
  <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
  <title>Elevate: Your Goal Setting Companion</title>
</head>

<body id="index-main">
  <?php
  require_once '../views/navbar.php';
  ?>

  <!-- bottom right button (Add Goal) -->
  <div id="add-btn">
    <a href="../views/goal-setting.php" id="set-btn-link" data-bs-toggle="tooltip" data-bs-placement="left"
      title="Add a goal">
      <i class="bi bi-plus-circle-fill fs-1 text-primary"></i></a>
  </div>

  <!-- Goals Section -->
  <section id="home-page" class="section pb-0" style="margin-top: 0px !important;">
    <!-- Hidden container to store username -->
    <div id="username" data-username="<?php echo $_SESSION['username']; ?>" style="display: none;"></div>

    <!-- Greeting and Live Clock -->
    <div class="row">
      <span id="typed-container" class="col">
        <p id="typed" class="lead fs-1"></p>
      </span>

      <span class="col text-end m-2 lead fw-bold">
        <p id="live-clock"></p>
      </span>
    </div>

    <!-- Goal Statistics Section -->
    <div class="container section-title" data-aos="fade-up">
      <h2 class="text-primary">My Goals</h2>
      <p>Track your progress, celebrate success, and adjust your strategy</p>
    </div>

    <div class="container-fluid">
      <div class="row gy-4 d-flex justify-content-center">
        <div class="col-xl-3 col-sm-6 col-md-4 d-flex" data-aos="flip-right" data-aos-delay="50">
          <div class="w-100 p-3 border shadow-lg rounded statistics-card" id="current-time">
            <div class="row d-flex align-items-center justify-content-between">
              <div class="col-auto"><i class="bi bi-calendar-plus icon text-primary"></i></div>
              <h4 class="col-auto my-auto ps-0">Today</h4>
              <p class="col-auto badge bg-primary position-relative float-end py-2 px-3" id="today"></p>
            </div>
            <div id="date-info">
            </div>
            <hr>
            <p>Lost time is never found, use it wisely</p>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-md-4 d-flex" data-aos="flip-right" data-aos-delay="100">
          <div class="w-100 p-3 border rounded shadow-sm statistics-card">
            <span id="goals-set" class="badge bg-secondary position-relative float-end px-5 py-2">00</span>
            <div class="row shadow-lg">
              <div class="col-auto"><i class="bi bi-patch-check-fill icon text-secondary"></i></div>
              <h4 class="col-auto">Goals Set</h4>
            </div>
            <p>Fresh beginnings, Upcoming challenges</p>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-md-4 d-flex" data-aos="flip-right" data-aos-delay="200">
          <div class="w-100 p-3 border rounded shadow-sm statistics-card">
            <span id="goals-achieved" class="badge bg-success position-relative float-end px-5 py-2">00</span>
            <div class="row shadow-lg">
              <div class="col-auto"><i class="bi bi-trophy-fill icon text-success"></i></div>
              <h4 class="col-auto my-auto">Goals Achieved</h4>
            </div>
            <p>Completed goals, well done!</p>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-md-4 d-flex" data-aos="flip-right" data-aos-delay="300">
          <div class="w-100 p-3 border rounded shadow-sm statistics-card">
            <span id="goals-missed" class="badge bg-danger position-relative float-end px-5 py-2">00</span>
            <div class="row shadow-lg">
              <div id="goals-missed" class="col-auto"><i class="bi bi-patch-exclamation-fill icon text-danger"></i>
              </div>
              <h4 class="col-auto my-auto">Goals Missed</h5>
            </div>
            <p>Hope you will do better next time!</p>
          </div>
        </div>

        <div class="col-xl-4 col-sm-6 col-md-4 d-flex" data-aos="flip-right" data-aos-delay="400">
          <div class="w-100 p-3 border rounded shadow-sm statistics-card">
            <span id="goals-in-progress" class="badge bg-info position-relative float-end px-5 py-2">00</span>
            <div class="row shadow-lg">
              <div id="goals-in-progress" class="col-12"><i class="bi bi-graph-up icon text-info"></i></div>
              <h4 class="col-12 my-auto">In Progress</h5>
            </div>
            <p>Active goals being worked on</p>
          </div>
        </div>

        <div class="col-xl-4 col-sm-6 col-md-4 d-flex" data-aos="flip-right" data-aos-delay="500">
          <div class="w-100  p-3 border rounded shadow-sm statistics-card">
            <span id="goals-on-hold" class="badge bg-warning position-relative float-end px-5 py-2">00</span>
            <div class="row shadow-lg">
              <div id="goals-on-hold" class="col-12"><i class="bi bi-lock-fill icon text-warning"></i></div>
              <h4 class="col-12 my-auto">On Hold</h5>
            </div>
            <p>Goals waiting clarification or on pause for other reasons</p>
          </div>
        </div>

      </div>

    </div>

  </section><!-- /Goals Section -->

  <!-- Top Three -->
  <section class="section my-0 py-5 gy-0">
    <div class="section-title">
      <h3>Upcoming Deadlines: Top 3 Goals</h3>
      <p>Stay ahead of the curve by prioritizing your most pressing goals.</p>
    </div>

    <div class="container-fluid">
      <?php
      $goals = include '../config/pressing-goals.php';
      ?>
      <div id="goals-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php foreach ($goals as $i => $goal) { ?>
            <div class="carousel-item <?php echo ($i == 0) ? 'active' : ''; ?>">
              <div class="col-md-12 col-lg-10 my-2 mx-auto">
                <article class="card position-relative rounded" id="card-border">
                  <a href="./display-goals.php" class="btn btn-primary position-absolute top-0 end-0 z-index-100">
                    <i class="bi bi-eye me-2"></i>View Goal
                  </a>
                  <header class="card-body d-flex">
                    <img src="../assets/img/goal.png" alt="Goal Image" class="rounded" width="50" height="50">
                    <div class="flex-grow-1 mx-3">
                      <h4 class="card-title" id="card-title">
                        <?php echo $goal['goal_name']; ?>
                      </h4>
                      <p class="card-text overflow-auto">
                        <?php echo $goal['goal_description']; ?>
                      </p>
                    </div>
                  </header>
                  <section class="card-body shadow-sm">
                    <div class="row">
                      <div class="col-12 overflow-auto">
                        <div class="progress col-10 offset-1">
                          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                            style="width: <?php echo $goal['progress_percentage']; ?>%;">
                            <?php echo $goal['progress_percentage']; ?>%
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>
                  <footer class="card-footer d-flex justify-content-between align-items-center w-100">
                    <div class="col">
                      <span>
                        <?php echo $goal['goal_category']; ?>
                      </span>
                    </div>
                    <div class="col">
                      <span class="text-danger">Due Date:
                        <?php echo $goal['target_date']; ?>
                      </span>
                    </div>
                    <div class="col" id="goal-status">
                      <span class="badge float-end bg-info ">
                        <?php echo $goal['status']; ?>
                      </span>
                    </div>
                  </footer>
                </article>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </section>

  <!-- Motivation Section -->
  <section id="motivation" class="motivation section my-0 py-5 gy-0">
    <div class="container section-title text-center">
      <h3>Daily Inspiration</h3>
      <p>Stay motivated with daily quotes and insights</p>
    </div>

    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">
      <div class="row gy-4">
        <div class="col-lg-6">
          <div class="card shadow-sm h-100" data-aos="fade-up" data-aos-delay="200">
            <div class="card-body d-flex flex-column justify-content-center align-items-center">
              <div class="text-center mb-4">
                <h4 class="text-info mb-3">Daily Inspiration</h4>
                <div class="quote-container p-4 bg-light rounded-3">
                  <blockquote class="mb-0">
                    <p class="lead" id="randomQuote"></p>
                    <footer class="blockquote-footer mt-3" id="author"></footer>
                  </blockquote>
                </div>
              </div>
              <div class="quote-actions mt-4">
                <button class="btn btn-outline-primary me-2" onclick="refreshQuote()">
                  <i class="bi bi-arrow-clockwise"></i> New Quote
                </button>
                <button class="btn btn-outline-success" onclick="shareQuote()">
                  <i class="bi bi-share"></i> Share
                </button>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-6">
          <div class="card shadow-sm h-100" data-aos="fade-up" data-aos-delay="500">
            <div class="card-body">
              <h4 class="card-title mb-4">Top 5 Goals</h4>
              <canvas id="top-goals" style="max-height: 300px;"></canvas>
              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  fetch("../config/analysis/top-goals.php")
                    .then(response => response.json())
                    .then(data => {
                      const labels = data.map(item => item.goal_name);
                      const progressPercentages = data.map(item => item.progress_percentage);

                      new Chart(document.getElementById('top-goals').getContext('2d'), {
                        type: 'bar',
                        data: {
                          labels: labels,
                          datasets: [{
                            label: 'Progress (%)',
                            data: progressPercentages,
                            backgroundColor: '#0d6efd',
                            borderColor: '#0d6efd',
                            borderWidth: 1
                          }]
                        },
                        options: {
                          responsive: true,
                          maintainAspectRatio: false,
                          scales: {
                            y: {
                              beginAtZero: true,
                              max: 100
                            }
                          }
                        }
                      });
                    });
                });
              </script>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- CTA Section -->
  <section class="cta-section py-5 bg-primary text-white">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-8 text-center text-lg-start">
          <h2 class="display-4 fw-bold mb-3">Ready to Achieve Your Goals?</h2>
          <p class="lead mb-0">Start your journey towards success today. Set your goals, track your progress, and
            celebrate your achievements.</p>
        </div>
        <div class="col-lg-4 text-center text-lg-end mt-4 mt-lg-0">
          <a href="./goal-setting.php" class="btn btn-light btn-lg px-5 py-3 rounded-pill shadow-sm">
            Create Your First Goal
          </a>
        </div>
      </div>
    </div>
  </section>
  <!-- Notebook -->
  <?php include "notebook.php" ?>

  <!-- Footer -->
  <?php include "footer.php" ?>

  <!-- Vendor Scripts -->
  <script src="/Elevate/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/Elevate/node_modules/aos/dist/aos.js"></script>
  <script src="/Elevate/node_modules/chart.js/dist/chart.umd.js"></script>
  <script src="/Elevate/node_modules/typed.js/dist/typed.umd.js"></script>
  <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

  <!-- Custom Scripts -->
  <script src="/Elevate/assets/js/notifications.js"></script>
  <script src="/Elevate/assets/js/main.js"></script>
  <script src="/Elevate/assets/js/notebook.js"></script>
  <script src="/Elevate/assets/js/index.js"></script>
  <script src="/Elevate/assets/js/theme.js"></script>
  <script src="/Elevate/assets/js/live-clock.js"></script>
  <script src="/Elevate/assets/js/greeting.js"></script>
  <script src="/Elevate/assets/js/delete-account.js"></script>
</body>

</html>