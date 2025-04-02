<!-- Top Navbar -->
<nav class="top-navbar navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container-fluid">
        <div class="d-flex align-items-center">
            <button class="btn btn-link text-white d-lg-none" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#mobileNav" aria-controls="mobileNav">
                <i class="bi bi-list fs-4"></i>
            </button>
            <a class="navbar-brand d-none d-lg-block logo" href="/Elevate/views/dashboard.php">
                <img src="/Elevate/assets/img/logo.jpg" alt="Elevate Logo" class="rounded-circle" style="height: 40px;">
            </a>
        </div>

        <div class="d-flex align-items-center">
            <!-- Support Dropdown -->
            <div class="dropdown me-3">
                <button class="btn btn-link text-white dropdown-toggle" type="button" id="supportDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-question-circle me-1"></i> Support
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="supportDropdown">
                    <li><a class="dropdown-item" href="/Elevate/views/faq.php"><i
                                class="bi bi-question-circle me-2"></i>FAQ</a></li>
                    <li><a class="dropdown-item" href="/Elevate/views/contact.php"><i
                                class="bi bi-envelope me-2"></i>Contact
                            Us</a></li>
                    <li><a class="dropdown-item" href="/Elevate/views/help.php"><i class="bi bi-book me-2"></i>Help
                            Center</a>
                    </li>
                </ul>
            </div>

            <!-- Account Settings Dropdown -->
            <div class="dropdown">
                <button class="btn btn-link text-white dropdown-toggle" type="button" id="accountDropdown"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-person-circle me-1"></i> Account
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                    <li><a class="dropdown-item" href="/Elevate/views/users-profile.php"><i
                                class="bi bi-person me-2"></i>Profile</a></li>
                    <li><a class="dropdown-item" href="/Elevate/views/notifications.php"><i
                                class="bi bi-bell me-2"></i>Notifications</a></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><button class="dropdown-item text-danger" id="logoutBtn"><i
                                class="bi bi-box-arrow-right me-2"></i>Logout</button></li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<!-- Desktop Sidebar -->
<aside class="sidebar d-none d-lg-block">
    <div class="sidebar-header p-0 m-0">
        <a href="/Elevate/views/dashboard.php">
            <img src="/Elevate/assets/img/logo.jpg" alt="Elevate Logo" class="logo"
                style="width: 100%; height: fit-content; background-image: url('/Elevate/assets/img/logo.jpg'); background-size: cover;">
        </a>
    </div>
    <nav class="sidebar-nav">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/dashboard.php">
                    <i class="bi bi-house-door"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/goal-setting.php">
                    <i class="bi bi-bullseye"></i>
                    <span>Set New Goal</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/display-goals.php">
                    <i class="bi bi-list-check"></i>
                    <span>View All Goals</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/analysis-insights.php">
                    <i class="bi bi-graph-up"></i>
                    <span>Progress Analytics</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/goal-categories.php">
                    <i class="bi bi-folder"></i>
                    <span>Goal Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/goal-templates.php">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Goal Templates</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

<!-- Mobile Navigation -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="mobileNav" aria-labelledby="mobileNavLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileNavLabel">
            <img src="/Elevate/assets/img/logo.jpg" alt="Elevate Logo" class="logo"
                style="width: 100%; background-image: url('/Elevate/assets/img/logo.jpg'); background-size: cover;">
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/dashboard.php">
                    <i class="bi bi-house-door"></i>
                    <span>Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/goal-setting.php">
                    <i class="bi bi-bullseye"></i>
                    <span>Set New Goal</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/display-goals.php">
                    <i class="bi bi-list-check"></i>
                    <span>View All Goals</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/analysis-insights.php">
                    <i class="bi bi-graph-up"></i>
                    <span>Progress Analytics</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/goal-categories.php">
                    <i class="bi bi-folder"></i>
                    <span>Goal Categories</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/Elevate/views/goal-templates.php">
                    <i class="bi bi-file-earmark-text"></i>
                    <span>Goal Templates</span>
                </a>
            </li>
        </ul>
    </div>
</div>

<style>
    /* Top Navbar */
    .top-navbar {
        height: 60px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        z-index: 1030;
    }

    .top-navbar .navbar-brand img {
        height: 40px;
        width: auto;
    }

    .top-navbar .btn-link {
        text-decoration: none;
        padding: 0.5rem 1rem;
    }

    .top-navbar .dropdown-menu {
        margin-top: 0.5rem;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .top-navbar .dropdown-item {
        padding: 0.5rem 1rem;
        color: var(--text-color);
    }

    .top-navbar .dropdown-item:hover {
        background-color: var(--light-gray);
        color: var(--accent-color);
    }

    /* Sidebar */
    .sidebar {
        position: fixed;
        top: 60px;
        left: 0;
        width: 250px;
        height: calc(100vh - 60px);
        background-color: var(--surface-color);
        box-shadow: 2px 0 4px rgba(0, 0, 0, 0.1);
        z-index: 1020;
    }

    .sidebar-header {
        padding: 1rem;
        text-align: center;
        border-bottom: 1px solid var(--border-color);
    }

    .sidebar-header .logo {
        height: 40px;
        width: auto;
    }

    .sidebar-nav {
        padding: 1rem 0;
    }

    .sidebar .nav-link {
        padding: 0.75rem 1.5rem;
        color: var(--text-color);
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .sidebar .nav-link i {
        margin-right: 0.75rem;
        font-size: 1.1rem;
    }

    .sidebar .nav-link:hover {
        background-color: rgba(0, 0, 0, 0.05);
        color: var(--accent-color);
    }

    .sidebar .nav-link.active {
        background-color: rgba(0, 0, 0, 0.1);
        color: var(--accent-color);
    }

    /* Mobile Navigation */
    .offcanvas {
        max-width: 250px;
        z-index: 1040;
    }

    .offcanvas-header {
        padding: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .offcanvas-body {
        padding: 1rem 0;
    }

    .offcanvas .nav-link {
        padding: 0.75rem 1.5rem;
        color: var(--text-color);
        display: flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .offcanvas .nav-link i {
        margin-right: 0.75rem;
        font-size: 1.1rem;
    }

    .offcanvas .nav-link:hover {
        background-color: rgba(0, 0, 0, 0.05);
        color: var(--accent-color);
    }


    /* Container Spacing */
    .container-fluid {
        padding: 0;
        margin: 0;
    }

    /* Card Spacing */
    .card {
        margin-bottom: 2rem;
        border-radius: 1rem;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }

    /* Section Spacing */
    .section {
        padding: 2rem 0;
    }

    /* Main Layout */
    /* Main Content */
    .main-content {
        flex: 1 0 auto;
        margin-left: 250px;
        transition: margin-left 0.3s ease;
        min-height: calc(100vh - 60px);
        max-width: calc(100% - 250px);
        margin-top: 60px;
    }

    /* Mobile Responsive */
    @media (max-width: 992px) {
        .main-content {
            margin-left: 0;
            padding: 1rem;
            max-width: 100%;
            margin-top: 60px;
        }

        .offcanvas-backdrop {
            z-index: 1035;
        }
    }
</style>


<!-- Required Scripts -->
<script src="../assets/js/delete-account.js"></script>
<script src="../assets/js/logout.js"></script>