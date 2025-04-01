<?php
session_start();

// If user is already logged in, redirect to home page
if (isset($_SESSION['username'])) {
    header('Location: dashboard.php');
    exit;
}
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
        <link rel="stylesheet" href="../node_modules/aos/dist/aos.css" />
        <!-- Custom CSS -->
        <link rel="stylesheet" href="../assets/css/main.css" />
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
        <title>Elevate: Login Page</title>
    </head>

    <body>
        <?php
            // Check if form is submitted
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                // Initialize error array
                $errors = [];

                // Validate input fields
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);

                // Validation rules
                if (empty($username)) {
                    $errors[] = 'Username is required';
                }
                if (empty($password)) {
                    $errors[] = 'Password is required';
                }

                // Check for valid credentials
                require_once '../config/db.php';
                $query = "SELECT id, username, email, password FROM users WHERE username = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("s", $username);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                if (empty($user)) {
                    $errors[] = 'Invalid username or password';
                } else {
                    if (!password_verify($password, $user['password'])) {
                        $errors[] = 'Invalid combination of username/password';
                    }
                }

                // Display errors or login user
                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        echo '<p style="color:red;">' . $error . '</p>';
                    }
                } else {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];

                    // Redirect to home page
                    header('Location: dashboard.php');
                    exit;
                }
            }
        ?>

        <?php if (!empty($errors)): ?>
          <script>
            document.addEventListener('DOMContentLoaded', function() {
              showError('<?php echo implode('<br>', $errors); ?>');
            });
          </script>
        <?php endif; ?>

        <div class="container align-content-center mt-5 rounded">
            <main class="form col-md-8 mx-auto shadow-sm border-bottom border-5 border-primary">
                <header class="bg-primary text-center p-4">
                    <h2 class="text-light">WELCOME TO ELEVATE</h2>
                </header>
                <section class="p-4">
                    <form action="" method="post">
                        <div class="input-group mb-3">
                            <label for="username" class="input-group-text text-primary">Username</label>
                            <input type="text" name="username" class="form-control" id="username" required
                                pattern="[a-zA-Z0-9]{3,}" aria-label="Username">
                        </div>
                        <div class="input-group mb-3">
                            <label for="password" class="input-group-text text-primary">Password</label>
                            <input type="password" name="password" class="form-control" id="password" required
                                pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                                aria-label="Password" />
                            <span class="input-group-text">
                                <i class="bi bi-eye" onclick="togglePasswordVisibility('password', this)"></i>
                            </span>
                        </div>

                        <div class="row justify-content-end">
                            <div class="col-3">
                                <button type="submit" class="btn btn-success w-100" id="loginButton">
                                    Login
                                </button>
                            </div>
                        </div>
                        <hr>
                        <p class="alert">
                            Don't have an account?
                            <a href="sign-up.php" class="text-primary">Sign up</a>
                        </p>
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
        <script src="../assets/js/login.js"></script>
    </body>

</html>