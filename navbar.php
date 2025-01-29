<nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom shadow-sm lh-lg z-index-2000 mb-5">
  <div class="container-fluid">
    <!-- Hamburger Menu Icon -->
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Profile Information -->
    <div class="d-flex align-items-center me-3 text-primary">
      <img src="img/logo.jpg" width="32" height="32" class="rounded-circle me-2" />
      <span><b>ELEVATE</b></span>
    </div>
    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-start d-lg-none w-xs-50" tabindex="-1" id="navbarSupportedContent"
      aria-labelledby="navbarSupportedContentLabel">
      <div class="offcanvas-header position-relative">
        <h5 class="offcanvas-title" id="navbarSupportedContentLabel">
          <img src="img/logo.jpg" class="mh-20 w-100" />
        </h5>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav ms-auto my-2 mb-lg-0">
          <!-- Primary Menu Items -->
          <li class="nav-item">
            <a class="nav-link" href="index.php" aria-selected="true">
              <i class="m-3 bi bi-house-door"></i> Home
            </a>
          </li>
          <!-- Goal Management Dropdown -->
          <li class="nav-item dropdown my-2">
            <span class="nav-link dropdown-toggle" href="#" id="goalManagementDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false" aria-label="Goal Management">
              <i class="m-3 bi bi-clipboard-check"></i> Goal Management
            </span>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="goalManagementDropdown">
              <li>
                <a class="dropdown-item" href="./goal-setting.php">
                  <i class="bi bi-calendar-plus"></i> Set Goal
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="./display-goals.php">
                  <i class="bi bi-list"></i> View All Goals
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="analysis-insights.php">
                  <i class="bi bi-list-check"></i> Analysis and Insights
                </a>
              </li>
            </ul>
          </li>
          <!-- Support Dropdown -->
          <li class="nav-item dropdown">
            <span class="nav-link dropdown-toggle" href="#" id="supportDropdown" role="button" data-bs-toggle="dropdown"
              aria-expanded="false" aria-label="Support">
              <i class="m-3 bi bi-chat-text"></i> Support
            </span>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="supportDropdown">
              <li>
                <a class="dropdown-item" href="#online-support">
                  <i class="bi bi-headset"></i> Online Support
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#contact-us">
                  <i class="bi bi-envelope"></i> Contact Us
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#feedback">
                  <i class="bi bi-chat-text"></i> Feedback
                </a>
              </li>
            </ul>
          </li>
          <!-- Account Settings Dropdown -->
          <li class="nav-item dropdown">
            <span class="nav-link dropdown-toggle" href="#" id="accountSettingsDropdown" role="button"
              data-bs-toggle="dropdown" aria-expanded="false" aria-label="Account Settings">
              <i class="m-3 bi bi-person-circle"></i> Account Settings
            </span>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountSettingsDropdown">
              <li>
                <a class="dropdown-item" href="users-profile.php">
                  <i class="bi bi-person-circle"></i> My Profile
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="#" id="deleteAccountBtn">
                  <i class="bi bi-person-dash"></i> Delete Account
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="mailto:muchinhairiano@gmail.com">
                  <i class="bi bi-question-circle"></i> Need Help
                </a>
              </li>

            </ul>
          </li>
          <li>
            <a class="nav-link logout-btn" href="#" id="logout-button1">
              <i class="m-3 bi bi-box-arrow-right"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>


    <!-- Horizontal Menu for Large Screens -->
    <div class="collapse navbar-collapse d-lg-block d-none" id="navbarSupportedContentHorizontal">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <!-- Primary Menu Items -->
        <li class="nav-item">
          <a class="nav-link" href="index.php" aria-selected="true">
            <i class="m-3 bi bi-house-door"></i> Home
          </a>
        </li>
        <!-- Goal Management Dropdown -->
        <li class="nav-item dropdown">
          <span class="nav-link dropdown-toggle" href="#" id="goalManagementDropdownHorizontal" role="button"
            data-bs-toggle="dropdown" aria-expanded="false" aria-label="Goal Management">
            <i class="m-3 bi bi-clipboard-check"></i> Goal Management
          </span>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="goalManagementDropdownHorizontal">
            <li>
              <a class="dropdown-item" href="goal-setting.php">
                <i class="bi bi-calendar-plus"></i> Set Goal
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="display-goals.php">
                <i class="bi bi-list"></i> View All Goals
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="analysis-insights.php">
                <i class="bi bi-list-check"></i> Analysis and Insights
              </a>
            </li>
          </ul>
        </li>
        <!-- Support Dropdown -->
        <li class="nav-item dropdown">
          <span class="nav-link dropdown-toggle" href="#" id="supportDropdownHorizontal" role="button"
            data-bs-toggle="dropdown" aria-expanded="false" aria-label="Support">
            <i class="m-3 bi bi-chat-text"></i> Support
          </span>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="supportDropdownHorizontal">
            <!-- Dropdown items -->
            <li>
              <a class="dropdown-item" href="#online-support">
                <i class="bi bi-headset"></i> Online Support
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#contact-us">
                <i class="bi bi-envelope"></i> Contact Us
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#feedback">
                <i class="bi bi-chat-text"></i> Feedback
              </a>
            </li>
          </ul>
        </li>
        <!-- Account Settings Dropdown -->
        <li class="nav-item dropdown">
          <span class="nav-link dropdown-toggle" href="#" id="accountSettingsDropdownHorizontal" role="button"
            data-bs-toggle="dropdown" aria-expanded="false" aria-label="Account Settings">
            <i class="m-3 bi bi-person-circle"></i> Account Settings
          </span>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountSettingsDropdownHorizontal">
            <!-- Dropdown items -->
            <li>
              <a class="dropdown-item" href="users-profile.php">
                <i class="bi bi-person-circle"></i> My Profile
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="#" id="deleteAccountBtn">
                <i class="bi bi-person-dash"></i> Delete Account
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="mailto:muchinhairiano@gmail.com">
                <i class="bi bi-question-circle"></i> Need Help
              </a>
            </li>
            <li>
              <a class="dropdown-item logout-btn" href="#" id="logout-button2">
                <i class="bi bi-box-arrow-right"></i> Logout
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>