<?php
// Check if user is logged in
require_once 'config/auth.php';
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

  <link rel="shortcut icon" href="./img/logo.jpg" type="image/x-icon">
  <link rel="stylesheet" href="vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="vendor/bootstrap-5.0.2-dist/css/bootstrap-icons/bootstrap-icons.css" />
  <link rel="stylesheet" href="vendor/aos/aos.css" />
  <link rel="stylesheet" href="vendor/quill/quill.snow.css">
  <link rel="stylesheet" href="./css/main.css" />
  <title>Elevate: Goal Setting and Tracking App</title>
</head>

<body id="index-main">
  <?php
  require_once 'navbar.php';
  ?>

  <!-- bottom right button (Add Goal) -->
  <div id="add-btn">
    <a href="goal-setting.php" id="set-btn-link" data-bs-toggle="tooltip" data-bs-placement="left" title="Add a goal">
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
    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2 class="text-primary">My Goals</h2>
      <p>Track your progress, celebrate success, and adjust your strategy</p>
    </div><!-- End Section Title -->

    <div class="container-fluid">
      <div class="row gy-4 d-flex justify-content-center">
        <div class="col-xl-3 col-sm-6 col-md-4 d-flex" data-aos="flip-right" data-aos-delay="50">
          <div class="w-100 p-3 border shadow-lg rounded statistics-card" id="current-time">
            <div class="row align-items-center">
              <div class="col-auto"><i class="bi bi-calendar-plus icon text-primary"></i></div>
              <h4 class="col-auto my-auto ps-0">Today</h5>
                <p class="col-auto badge bg-primary position-fixed end-0 px-4 py-2 me-4 mt-1" id="today"></p>
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
              <h4 class="col-auto">Goals Set</h5>
            </div>
            <p>Fresh beginnings, Upcoming challenges</p>
          </div>
        </div>

        <div class="col-xl-3 col-sm-6 col-md-4 d-flex" data-aos="flip-right" data-aos-delay="200">
          <div class="w-100 p-3 border rounded shadow-sm statistics-card">
            <span id="goals-achieved" class="badge bg-success position-relative float-end px-5 py-2">00</span>
            <div class="row shadow-lg">
              <div class="col-auto"><i class="bi bi-trophy-fill icon text-success"></i></div>
              <h4 class="col-auto my-auto">Goals Achieved</h5>
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
      <p>Stay ahead of the curve by prioritizing your most pressing goals. Here are your top three goals that require
        attention now to ensure timely completion.</p>
    </div>

    <div class="container-fluid">
      <?php
      // Include the pressing-goals.php file
      $goals = include './config/pressing-goals.php';
      ?>
      <!-- Create the carousel -->
      <div id="goals-carousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
          <?php foreach ($goals as $i => $goal) { ?>
            <div class="carousel-item <?php echo ($i == 0) ? 'active' : ''; ?>">
              <div class="col-md-12 col-lg-10 my-2 mx-auto">
                <article class="card position-relative rounded" id="card-border">
                  <a href="display-goals.php" class="btn btn-primary position-absolute top-0 end-0 z-index-100">
                    <i class="bi bi-eye me-2"></i>View Goal
                  </a>
                  <header class="card-body d-flex">
                    <img src="./img/time.jpg" alt="Goal Image" class="rounded" width="50" height="50">
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
                    <!-- Task Container -->
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
          <!-- Carousel controls -->
          <div class="carousel-control-container d-flex justify-content-between">
            <button class="carousel-control-prev my-5 mx-auto" type="button" data-bs-target="#goals-carousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next my-5 mx-auto" type="button" data-bs-target="#goals-carousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>

        <!-- Carousel Indicators -->
        <div class="container d-flex justify-content-center mt-5">
          <div class="carousel-indicators">
            <?php foreach ($goals as $i => $goal) { ?>
              <button type="button" data-bs-target="#goals-carousel" data-bs-slide-to="<?php echo $i; ?>"
                class="bg-primary <?php echo ($i == 0) ? 'active' : ''; ?> z-index-0"></button>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>



  <!-- Motivation Section -->
  <section id="motivation" class="motivation section my-0 py-5 gy-0">

    <!-- Section Title -->
    <div class="container section-title">
      <h3>Share and Motivate</h3>
      <p>Find motivation in quotes, tips and personl stories. Share your own expriences to inspire others.</p>
    </div><!-- End Section Title -->

    <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4 ">
        <div class="col-lg-6 ">
          <div class="row gy-4">

            <div class="col-12 px-0">
              <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                data-aos-delay="200">
                <div class="m-2">
                  <h4 class="text-info">Daily Inspirations</h4>
                  <blockquote class="d-flex justify-content-between">
                    <p class="lead" id="randomQuote"></p>
                    <cite id="author" class="float-right"></cite>
                  </blockquote>

                </div>

              </div>

            </div><!-- End Daily Motivation Section -->

            <!-- Call To Action Section -->
            <div class="col-12 section dark-background w-100 border rounded shadow-lg">
              <div class="d-flex flex-column justify-content-center align-items-center" data-aos="fade-up"
                data-aos-delay="300">
                <div class="row p-4" data-aos="zoom-in" data-aos-delay="100">
                  <div class="col-xl-8 text-center text-xl-start">
                    <h3>Unlock Your Potential</h3>
                    <p class="mb-4">Don't wait for tommorow. Start setting your goals today and make progress towards
                      your dreams.</p>
                  </div>
                  <div class="col-xl-4 cta-btn-container text-center align-content-center">
                    <a class="btn btn-grad rounded-pill d-span shadow-sm" href="goal-setting.php">Create A Goal</a>
                  </div>
                </div>
              </div>
            </div><!-- End Info Item -->

          </div>
        </div>

        <div class="col-lg-6">
          <form action="" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
            <div class="row gy-4">
              <div class="section-title" style="padding-bottom: 3px;">
                <h4 class="sub-title">
                  <i class="bi bi-envelope m-3 fs-4"></i>Inspire the Community
                </h4>
                <p>
                  Share your thoughts, experiences, tips or favourite quotes. Your words matter!
                </p>
              </div>

              <div class="col-md-6 ">
                <input type="text" class="form-control" name="username" placeholder="Your name" required>
              </div>
              <div class="col-md-6">
                <select class="form-control" id="type" required>
                  <option value="">What do want to share?</option>
                  <option value="experiance">An Experience</option>
                  <option value="quote">A Quote</option>
                  <option value="tip">A Tip</option>
                  <option value="other">Other</option>
                </select>
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="message" rows="4" placeholder="Message" required></textarea>
              </div>

              <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit" class="btn btn-grad rounded-pill px-5 py-2">Send Message</button>
              </div>

            </div>
          </form>
        </div><!-- End Contact Form -->
      </div>
    </div>
  </section><!-- /Motivation Section -->

  <!-- Notebook -->
  <!-- Button to trigger modal -->
  <button id="notebook-btn-custom-position" class="btn btn-primary rounded-pill shadow-md pe-5 py-2 border-0"
    data-bs-toggle="modal" data-bs-target="#notebookModal">
    <i class="bi bi-pencil-square"></i> Open Notebook
  </button>

  <!-- Modal -->
  <div class="modal fade" id="notebookModal" tabindex="-1" aria-labelledby="notebookModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="text-primary"><i class="bi bi-pencil-square fs-1"></i>Notebook</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body container">
          <div class="row">
            <div class="col-xs-12 col-md-4 mb-3 shadow-sm">
              <h5>All Notes</h5>
              <ul id="note-list" class="list-group list-group-flush d-flex flex-row flex-md-column">
              </ul>
            </div>
            <div class="col-xs-12 col-md-8 p-0">
              <!-- title input and quill editor -->
              <input type="text" id="note-title" class="form-control border-bottom-0" value=""
                placeholder="Note Title" required>
              <div id="quill-editor" style="height: 250px;"></div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <!-- save btn -->
          <button id="edit-note" class="btn btn-primary m-2 d-none">Edit Note</button>
          <button id="save-note" class="btn btn-success m-2">Save Note</button>
          <button id="update-note" class="btn btn-success m-2 d-none">Save Update</button>
        </div>
      </div>
    </div>
  </div>


  <script scr="vendor/typed/typed.umd.js"></script>
  <script src="vendor/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/aos/aos.js"></script>
  <script src="vendor/quill/quill.js"></script>
  <script src="./scripts/live-clock.js"></script>
  <script src="./scripts/greeting.js"></script>

  <script src="./scripts/main.js"></script>
  <script src="./scripts/index.js"></script>
  <script src="./scripts/toasts.js"></script>
  <script src="./scripts/notebook.js"></script>
  <script src="./scripts/theme.js"></script>
  <script src="vendor/typed.js/typed.umd.js"></script>



  <?php
  include_once 'footer.php'
  ?>
</body>

</html>