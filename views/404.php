<?php
// Check if user is logged in
require_once '../config/auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Elevate: Your ultimate goal setting and tracking web app to help you achieve your aspirations and maximum potential.">
    <meta name="keywords" content="goal setting, goal analysis, goal tracking, productivity, personal development, Elevate">
    <meta name="author" content="Anotida Muchinhairi">

    <link rel="shortcut icon" href="../assets/img/logo.jpg" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" />
    <!-- AOS CSS -->
    <link rel="stylesheet" href="../node_modules/aos/dist/aos.css" />
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <title>404 - Page Not Found | Elevate</title>
</head>

<body>
    <?php include "navbar.php" ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="container-fluid d-flex align-items-center justify-content-center" style="min-height: calc(100vh - 60px);">
            <div class="text-center">
                <h1 class="display-1 fw-bold text-primary mb-4">404</h1>
                <h2 class="h3 mb-4">Oops! Page Not Found</h2>
                <p class="lead mb-5">The page you're looking for doesn't exist or has been moved.</p>
                <div class="d-flex justify-content-center gap-3">
                    <a href="../views/dashboard.php" class="btn btn-primary btn-lg">
                        <i class="bi bi-house-door me-2"></i>Go to Homepage
                    </a>
                    <button onclick="history.back()" class="btn btn-outline-primary btn-lg">
                        <i class="bi bi-arrow-left me-2"></i>Go Back
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include "footer.php" ?>

        <!-- Vendor Scripts -->
        <script src="/Elevate/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="/Elevate/node_modules/aos/dist/aos.js"></script>
        <script src="/Elevate/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

        <!-- Custom Scripts -->
        <script src="/Elevate/assets/js/main.js"></script>
    </div>
</body>

</html> 