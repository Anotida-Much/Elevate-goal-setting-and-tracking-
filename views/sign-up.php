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
    <link rel="stylesheet" href="../node_modules/aos/dist/aos.css" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
    <title>Elevate: Sign Up</title>
</head>

<body class="mt-5 mb-5">
    <?php
    ob_start();
    require_once '../config/db.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = [];
        $full_name = trim($_POST['full_name']);
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);
        $country = trim($_POST['country']);

        if (empty($full_name)) $errors[] = 'Full name is required';
        if (empty($username)) $errors[] = 'Username is required';
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Valid email is required';
        if (empty($password) || strlen($password) < 8) $errors[] = 'Password must be at least 8 characters';
        if ($password !== $confirm_password) $errors[] = 'Passwords do not match';

        $query = "SELECT * FROM users WHERE email = ? OR username = ?";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $email, $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) $errors[] = 'Email or username already exists';

        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo '<p style="color:red;">' . htmlspecialchars($error) . '</p>';
            }
        } else {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $query = "INSERT INTO users (full_name, username, email, password, country) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $query);
            mysqli_stmt_bind_param($stmt, "sssss", $full_name, $username, $email, $hashed_password, $country);
            mysqli_stmt_execute($stmt);
            header('Location: login.php');
            exit;
        }
    }
    ob_end_flush();
    ?>

    <div class="container-fluid">
        <main class="form col-md-8 offset-md-2 shadow-sm border-bottom border-5 border-primary">
            <header class="bg-primary py-4 px-2 text-light text-center">
                <h2 class="text-light">Join Us Today</h2>
                <p class="lead">Become part of our family! Let's embark on this journey together.</p>
            </header>
            <section class="ps-4 pe-4">
                <form action="" method="POST" enctype="multipart/form-data">
                    <fieldset>
                        <div class="form-group">
                            <label for="inputName" class="form-label text-primary">Full Name</label>
                            <input type="text" name="full_name" class="form-control" id="inputName" required
                                aria-label="Full Name" aria-required="true" pattern="[a-zA-Z\s]{2,}"
                                title="Please enter your full name (at least 2 characters)" autofocus>
                        </div>

                        <div class="form-group">
                            <label for="inputUsername" class="form-label text-primary">Username</label>
                            <input type="text" name="username" class="form-control" id="inputUsername" required
                                aria-label="Username" aria-required="true" pattern="[a-zA-Z0-9]{3,}"
                                title="Please enter a valid username (at least 3 characters, alphanumeric)">
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputEmail" class="form-label text-primary">Email</label>
                                    <input type="email" name="email" class="form-control" id="inputEmail" required
                                        aria-label="Email" aria-required="true"
                                        pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                        title="Please enter a valid email address">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="inputCountry" class="form-label text-primary">Country</label>
                                    <input type="text" name="country" class="form-control" id="inputCountry"
                                        required aria-label="Country" aria-required="true">
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="inputPassword" class="form-label text-primary">Password</label>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" id="inputPassword"
                                    minlength="8" aria-label="Password"
                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                                    title="Please enter a strong password (at least 8 characters, 1 uppercase, 1 lowercase, 1 digit, 1 special character)">
                                <span class="input-group-text">
                                    <i class="bi bi-eye" onclick="togglePasswordVisibility('inputPassword', this)"></i>
                                </span>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="confirm-password" class="form-label text-primary">Confirm Password</label>
                            <div class="input-group mb-3">
                                <input type="password" name="confirm_password" class="form-control"
                                    id="confirm-password" minlength="8" aria-label="Password"
                                    pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                                    title="Please enter a strong password (at least 8 characters, 1 uppercase, 1 lowercase, 1 digit, 1 special character)">
                                <span class="input-group-text">
                                    <i class="bi bi-eye" onclick="togglePasswordVisibility('confirm-password', this)"></i>
                                </span>
                            </div>
                        </div>

                        <div class="form-group form-check pb-3">
                            <input class="form-check-input" type="checkbox" id="gridCheck" required>
                            <label class="form-check-label" for="gridCheck">
                                By signing up you agree to our
                                <a href="#" class="text-primary">Privacy Policy</a> and
                                <a href="#" class="text-primary">Terms and Conditions</a>
                            </label>
                        </div>
                    </fieldset>
                    <div class="row offset-md-4">
                        <div class="col-xs-12 col-sm-5 offset-sm-1 my-1">
                            <button type="reset" class="btn btn-danger w-100" id="cancelButton">
                                Cancel
                            </button>
                        </div>
                        <div class="col-xs-12 col-sm-5 offset-sm-1 my-1">
                            <button type="submit" class="btn btn-success w-100" id="submitForm">
                                Sign Up
                            </button>
                        </div>
                    </div>
                    <div class="text-center pt-4">
                        <p>
                            Already have an account?
                            <a href="login.php" class="text-primary">Log In</a>
                        </p>
                    </div>
                </form>
            </section>
        </main>
    </div>

    <!-- Vendor Scripts -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/aos/dist/aos.js"></script>
    <script src="../node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <!-- Custom Scripts -->
    <script src="../assets/js/notifications.js"></script>
    <script src="../assets/js/toggle-password-visibility.js"></script>
    <script src="../assets/js/sign-up.js"></script>
    <?php if (!empty($errors)): ?>
      <script>
        document.addEventListener('DOMContentLoaded', function() {
          showError('<?php echo implode('<br>', $errors); ?>');
        });
      </script>
    <?php endif; ?>
</body>

</html>