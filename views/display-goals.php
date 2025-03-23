<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description"
        content="Elevate: Your ultimate goal setting and tracking web app to help you achieve your aspirations and maximum potential.">
    <meta name="keywords" content="goal setting, goal tracking, productivity, personal development, Elevate">
    <meta name="author" content="Anotida Muchinhairi">

    <link rel="shortcut icon" href="../assets/img/logo.jpg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="../assets/vendor/bootstrap-5.0.2-dist/css/bootstrap-icons/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../assets/vendor/aos/aos.css" />
    <link rel="stylesheet" href="../assets/vendor/quill/quill.snow.css">
    <link rel="stylesheet" href="../assets/css/main.css" />
    <title>Elevate: My Goals</title>
</head>


<body>
    <?php
    require_once '../config/display-goals-config.php';
    require_once 'navbar.php';
    ?>

    <div class="row position-relative mt-5 pt-5 me-auto">
        <div class="d-flex align-items-center justify-content-end">
            <div class="col-auto search-bar position-relative me-5 w-50">
                <input type="search" class="form-control" name="query" placeholder="Search goals..."><i class="bi bi-search position-absolute top-50 end-0 translate-middle"></i>
            </div>

            <!-- Filter Buttons -->
            <div class="col-auto mx-2 filter-buttons dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Filter by Status
                </button>
                <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                    <li><button class="dropdown-item filter-btn" data-filter="*">Show All</button></li>
                    <li><button class="dropdown-item filter-btn" data-filter=".in-progress">In Progress</button></li>
                    <li><button class="dropdown-item filter-btn" data-filter=".on-hold">On Hold</button></li>
                    <li><button class="dropdown-item filter-btn" data-filter=".completed">Completed</button></li>
                    <li><button class="dropdown-item filter-btn" data-filter=".missed">Missed</button></li>
                </ul>
            </div>

            <!-- Sort Buttons -->
            <div class="col-auto sort-buttons dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort by
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                    <li><a class="dropdown-item" href="#">Default Order</a></li>
                    <li><a class="dropdown-item" href="#">Due Date</a></li>
                    <li><a class="dropdown-item" href="#">Progress</a></li>
                    <li><a class="dropdown-item" href="#">Starting Date</a></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Global Progress Bar -->
    <div class="global-progress container mt-2 mt-5">
        <h3>Overall Progress</h3>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;"></div>
        </div>
    </div>
    <!-- Goal Container -->
    <main class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <?php foreach ($goal_data as $data) { ?>
                    <!-- beginning of goal container -->
                    <article class="card border-bottom my-5">
                        <header class="card-body d-flex">
                            <img src="../assets/img/time.jpg" alt="Goal Image" class="rounded" width="50" height="50">
                            <div class="flex-grow-1 mx-3">
                                <h4 class="card-title" id="card-title" goal-id="<?= $data['goal']['id'] ?>">
                                    <?= $data['goal']['goal_name'] ?>
                                </h4>
                                <p class="card-text overflow-auto">
                                    <?= $data['goal']['goal_description'] ?>
                                </p>
                            </div>
                            <!-- Dropdown menu content -->
                            <div class="dropdown">
                                <button class="btn btn-outline-primary" type="button" id="goalOptions" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Goal Options">
                                    <i class="bi bi-three-dots fs-3"></i>
                                </button>
                                <ul class="dropdown-menu text-light" aria-labelledby="goalOptions">
                                    <li><a class="dropdown-item" href="#" aria-label="add-tasks"><i class="bi bi-plus-circle"></i>Add More Tasks</a></li>
                                    <li><a class="dropdown-item" href="#" aria-label="pause"><i class="bi bi-pause-circle"></i>Pause Goal</a></li>
                                    <li><a class="dropdown-item" href="#" aria-label="resume"><i class="bi bi-arrow-clockwise"></i>Resume Goal</a></li>
                                    <li><a class="dropdown-item" href="#" aria-label="reschedule"><i class="bi bi-calendar-plus"></i>Reschedule Goal</a></li>
                                    <li><a class="dropdown-item" href="#" aria-label="mark-complete"><i class="bi bi-check-circle"></i>Mark as complete</a></li>
                                    <li><a class="dropdown-item" href="#" aria-label="share"><i class="bi bi-share"></i>Share Goal</a></li>
                                    <li><a class="dropdown-item" href="#" aria-label="update"><i class="bi bi-pencil-square"></i>Edit Goal</a></li>
                                    <li><a class="dropdown-item text-warning" href="#" aria-label="missed"><i class="bi bi-exclamation-circle"></i>Mark As Missed</a></li>
                                    <li><a class="dropdown-item text-danger" href="#" aria-label="delete"><i class="bi bi-trash"></i>Delete Goal</a></li>
                                </ul>
                            </div>
                        </header>
                        <section class="card-body border">
                            <span id="task-status"></span>
                            <!-- Task Container -->
                            <div class="row">
                                <div class="col-12 overflow-auto">
                                    <h5>Tasks</h5>
                                    <ul class="task-list list-unstyled">
                                        <?php foreach ($data['tasks'] as $task) { ?>
                                            <li class="task <?= $task['completed'] ? 'completed' : '' ?>">
                                                <input type="checkbox" id="<?= $task['id'] ?>" aria-label="<?= $task['task_name'] ?>" <?= $task['completed'] ? 'checked' : '' ?>>
                                                <label for="<?= $task['id'] ?>">
                                                    <?= $task['task_name'] ?>
                                                </label>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                </div>
                                <div class="progress col-10 offset-1">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">0%</div>
                                </div>
                            </div>
                        </section>
                        <footer class="card-footer d-flex justify-content-between align-items-center w-100">
                            <div class="col">
                                <span><?= $data['goal']['goal_category'] ?></span>
                            </div>
                            <div class="col">
                                <span>Due Date: <?= $data['goal']['target_date'] ?></span>
                            </div>
                            <div class="col" id="goal-status">
                                <span class="badge float-end bg-info w-75 py-3"><?= $data['goal_status'] ?></span>
                            </div>
                        </footer>
                    </article>
                <?php } ?>
            </div>
        </div>
    </main>

    <script src="../assets/vendor/bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/vendor/aos/aos.js"></script>
    <script src="../assets/vendor/quill/quill.js"></script>
    <script src="../assets/js/display.js"></script>

    <?php include "footer.php" ?>
</body>

</html>
