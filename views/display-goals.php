<?php
session_start();
require_once '../config/display-goals-config.php';
require_once 'navbar.php';
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

    <link rel="shortcut icon" href="../assets/img/logo.jpg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" />
    <!-- AOS CSS -->
    <link rel="stylesheet" href="../node_modules/aos/dist/aos.css" />
    <!-- Quill CSS -->
    <link rel="stylesheet" href="../node_modules/quill/dist/quill.snow.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <style>
        /* Filter classes and default status styling */
        .in_progress,
        article.card[class*="in_progress"] {
            border-left: 4px solid #0dcaf0;
            border-right: 4px solid #0dcaf0;
        }

        .on_hold,
        article.card[class*="on_hold"] {
            border-left: 4px solid #ffc107;
            border-right: 4px solid #ffc107;
        }

        .completed,
        article.card[class*="completed"] {
            border-left: 4px solid #198754;
            border-right: 4px solid #198754;
        }

        .missed,
        article.card[class*="missed"] {
            border-left: 4px solid #dc3545;
            border-right: 4px solid #dc3545;
        }

        /* Card styling */
        article.card {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            margin-bottom: 1.5rem;
            position: relative;
            overflow: visible;/
        }

        article.card:hover {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }


        /* Ensure dropdown stays within viewport */
        @media (min-width: 768px) {
            .col-md-6:first-child .dropdown-menu {
                right: auto;
                left: 0;
            }

            .col-md-6:last-child .dropdown-menu {
                right: 0;
                left: auto;
            }
        }

        /* Large and Medium screens (2 goals per row) */
        @media (min-width: 768px) {
            .row .col-md-6:nth-child(3n) .card {
                background-color: #f8f9fa;
            }
        }

        /* Mobile screens (1 goal per row) */
        @media (max-width: 767px) {
            .row .col-12:nth-child(odd) .card {
                background-color: #f8f9fa;
            }
        }


        /* Task styling */
        .task.completed label {
            text-decoration: line-through;
            color: #6c757d;
        }

        /* Ensure dropdown items are clickable */
        .dropdown-item {
            cursor: pointer;
        }

        /* Hide elements with display: none */
        [style*="display: none"] {
            display: none !important;
        }

        /* Status badge colors */
        #goal-status .badge {
            color: white;
        }

        .in_progress #goal-status .badge {
            background-color: #0dcaf0 !important;
        }

        .on_hold #goal-status .badge {
            background-color: #ffc107 !important;
        }

        .completed #goal-status .badge {
            background-color: #198754 !important;
        }

        .missed #goal-status .badge {
            background-color: #dc3545 !important;
        }

        /* Task container styling */
        .erflow-y: auto;
        padding-right: 10px;

        margintask-container {
            max-height: 120px;
            ov-bottom: 1rem;
        }

        .task-container::-webkit-scrollbar {
            width: 6px;
        }

        .task-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }

        .task-container::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .task-container::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Task list and item styling */
        .task-list {
            margin: 0;
            padding: 0;
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .task-list li {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            min-height: 24px;
            background-color: #f8f9fa;
            border-radius: 4px;
            border: 1px solid #dee2e6;
        }

        .task-list input[type="checkbox"] {
            margin-right: 0.5rem;
            flex-shrink: 0;
        }

        .task-list label {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            margin: 0;
            padding: 0;
            line-height: 1.2;
            max-width: 200px;
        }

        .task.completed label {
            text-decoration: line-through;
            color: #6c757d;
        }

        .task.completed {
            background-color: #e9ecef;
        }

        .card-text {
            max-height: 100px;
            overflow-y: auto;
        }
    </style>
    <title>Elevate: My Goals</title>
</head>


<body>
    <div class="row position-relative mt-5 pt-5">
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-end gap-2 w-100">

            <!-- Search Bar -->
            <div class="col-auto">
                <input type="search" class="form-control" name="query" placeholder="Search goals..."
                    style="min-width: 200px;">
            </div>

            <!-- Filter Buttons -->
            <div class="col-auto dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="filterDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Filter
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
            <div class="col-auto dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="sortDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Sort
                </button>
                <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                    <li><button class="dropdown-item sort-btn" data-sort="default">Default Order</button></li>
                    <li><button class="dropdown-item sort-btn" data-sort="due-date">Due Date</button></li>
                    <li><button class="dropdown-item sort-btn" data-sort="progress">Progress</button></li>
                    <li><button class="dropdown-item sort-btn" data-sort="start-date">Starting Date</button></li>
                </ul>
            </div>

        </div>
    </div>



    <!-- Global Progress Bar -->
    <div class="global-progress container mt-2 mt-5">
        <h3>Overall Progress</h3>
        <div class="progress">
            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 0%;">
            </div>
        </div>
    </div>
    <!-- Goal Container -->
    <main class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row g-4" id="goals-container">
                    <?php foreach ($goal_data as $data) {
                        $statusClass = strtolower(str_replace(' ', '-', $data['goal_status']));
                        ?>
                        <!-- beginning of goal container -->
                        <article class="col-md-6">
                            <div class="card h-100 <?php echo $statusClass; ?>">
                                <header class="card-body d-flex">
                                    <img src="../assets/img/goal.png" alt="Goal Image" class="rounded" width="50"
                                        height="50">
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
                                        <button class="btn btn-outline-primary" type="button" id="goalOptions"
                                            data-bs-toggle="dropdown" aria-expanded="false" aria-label="Goal Options">
                                            <i class="bi bi-three-dots fs-3"></i>
                                        </button>
                                        <ul class="dropdown-menu text-light" aria-labelledby="goalOptions">
                                            <li><a class="dropdown-item" href="#" aria-label="add-tasks"><i
                                                        class="bi bi-plus-circle-fill"></i> Add More Tasks</a></li>
                                            <li><a class="dropdown-item" href="#" aria-label="pause"><i
                                                        class="bi bi-pause-circle-fill"></i> Pause Goal</a></li>
                                            <li><a class="dropdown-item" href="#" aria-label="resume"><i
                                                        class="bi bi-arrow-clockwise"></i> Resume Goal</a></li>
                                            <li><a class="dropdown-item" href="#" aria-label="reschedule"><i
                                                        class="bi bi-calendar-plus-fill"></i> Reschedule Goal</a></li>
                                            <li><a class="dropdown-item" href="#" aria-label="mark-complete"><i
                                                        class="bi bi-check-circle-fill"></i> Mark as complete</a></li>
                                            <li><a class="dropdown-item" href="#" aria-label="share"><i
                                                        class="bi bi-share-fill"></i> Share Goal</a></li>
                                            <li><a class="dropdown-item" href="#" aria-label="update"><i
                                                        class="bi bi-pencil-fill"></i> Edit Goal</a></li>
                                            <li><a class="dropdown-item text-warning" href="#" aria-label="missed"><i
                                                        class="bi bi-exclamation-circle-fill"></i> Mark As Missed</a></li>
                                            <li><a class="dropdown-item text-danger" href="#" aria-label="delete"><i
                                                        class="bi bi-trash-fill"></i> Delete Goal</a></li>
                                        </ul>
                                    </div>
                                </header>
                                <section class="card-body border">
                                    <span id="task-status"></span>
                                    <!-- Task Container -->
                                    <div class="row">
                                        <div class="col-12">
                                            <h5>Tasks</h5>
                                            <div class="task-container">
                                                <ul class="task-list list-unstyled">
                                                    <?php foreach ($data['tasks'] as $task) { ?>
                                                        <li class="task <?= $task['completed'] ? 'completed' : '' ?>">
                                                            <input type="checkbox" id="<?= $task['id'] ?>"
                                                                aria-label="<?= $task['task_name'] ?>" <?= $task['completed'] ? 'checked' : '' ?>>
                                                            <label for="<?= $task['id'] ?>">
                                                                <?= $task['task_name'] ?>
                                                            </label>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="progress col-10 offset-1 mt-3">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                role="progressbar" style="width: 0%;">0%</div>
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
                            </div>
                        </article>
                    <?php } ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include "footer.php" ?>

    <!-- Notebook -->
    <?php include "notebook.php" ?>

    <!-- Vendor Scripts -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/aos/dist/aos.js"></script>
    <script src="../node_modules/chart.js/dist/chart.umd.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <!-- Custom Scripts -->
    <script src="../assets/js/notifications.js"></script>
    <script src="../assets/js/display.js"></script>
    <script src="../assets/js/goal-filters.js"></script>
</body>

</html>