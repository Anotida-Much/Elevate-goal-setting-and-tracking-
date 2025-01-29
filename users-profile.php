<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Elavate: Your ultimate goal setting and tracking web app to help you achieve your aspirrations and maximum potential.">
  <meta name="keywords" content="goal setting, goal tracking, productivity, personal development, Elevate">
  <meta name="author" keywords="Anotida Muchinhairi">

  <link rel="shortcut icon" href="./img/logo.jpg" type="image/x-icon">
  <link href="vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/bootstrap-5.0.2-dist/css/bootstrap-icons/bootstrap-icons.min.css" rel="stylesheet">
  <link href="css/main.css" rel="stylesheet">

</head>

<body>
  <?php
  // Check if user is logged in
  require_once 'config/auth.php';
  require_once 'navbar.php';
  ?>

  <div id="toast-container" class="position-fixed top-0 end-0 p-3" style="z-index: 1050;">
    <!-- Toasts will be appended here -->
  </div>


  <main id="main" class="container-fluid mt-5 pt-5">

    <div class="container section-title" data-aos="fade-up">
      <h2>My Profile</h2>
      <p>Manage your Account Information and Settings</p>
    </div><!-- End Section Title -->

    <section class="section profile text-dark">
      <div class="row">
        <div class="col-xl-4 mb-3">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
              <h3 id="fullname" class="text-primary">Full Name</h3>
              <h5 id="username" class="text-info">Username</h5>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">

                <li class="nav-item">
                  <button class="nav-link active" data-bs-toggle="tab"
                    data-bs-target="#profile-overview">Overview</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                </li>

                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                    Password</button>
                </li>

              </ul>
              <div class="tab-content pt-2">

                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                  <h4 class="card-title lead"><b>Profile Details</b></h4>

                  <div class="row">
                    <div class="col-md-4 label "><b>Full Name</b></div>
                    <div class="col-md-8 text-primary" id="full-name"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 label"><b>Username</b></div>
                    <div class="col-md-8 text-primary" id="user-name"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 label"><b>Country</b></div>
                    <div class="col-md-8 text-primary" id="country"></div>
                  </div>

                  <div class="row">
                    <div class="col-md-4 label"><b>Email</b></div>
                    <div class="col-md-8 text-primary" id="email"></div>
                  </div>

                </div>

                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form id="profile-edit">

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="fullName" type="text" class="form-control" id="full_name" value="" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">Username</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="job" type="text" class="form-control" id="user_name" value="" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="country" type="text" class="form-control" id="user_country" value="" required>
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="email" type="email" class="form-control" id="user_email" value="" required>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade pt-3" id="profile-settings">
                  <!-- Settings Form -->
                  <form>
                    <!-- Theme Toggle Button -->
                    <div class="row mb-3">
                      <label for="theme-toggle" class="col-md-4 col-lg-3 col-form-label">Theme</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check form-switch">
                          <input class="form-check-input" type="checkbox" id="theme-toggle" />
                          <label class="form-check-label" for="theme-toggle" id="theme-toggle-label">Dark Mode</label>
                        </div>
                      </div>
                    </div>
                    <!-- Rest of the settings form -->
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Choose what kind notifications
                        you want
                        receive</label>
                      <div class="col-md-8 col-lg-9">
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="securityNotify">
                          <label class="form-check-label" for="securityNotify">
                            Goal Progress Notifications
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="security" checked>
                          <label class="form-check-label" for="security">
                            Account & Security Notifications
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="newProducts" checked>
                          <label class="form-check-label" for="newProducts">
                            Engagement & Motivational Notifications
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" id="administrative" checked disabled>
                          <label class="form-check-label" for="administrative">
                            Administrative Notifications
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                  </form><!-- End settings Form -->
                </div>


                <div class="tab-pane fade pt-3" id="profile-change-password">
                  <!-- Change Password Form -->
                  <form id="profile-change-password">

                    <div class="row mb-3">
                      <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="password" type="password" class="form-control" id="currentPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                      </div>
                    </div>

                    <div class="row mb-3">
                      <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New
                        Password</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                  </form><!-- End Change Password Form -->

                </div>

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->



  <script src="vendor/bootstrap-5.0.2-dist/js/bootstrap.bundle.js"></script>
  <script src="./scripts/toasts.js"></script>
  <script src="./scripts/theme.js"></script>
  <script src="./scripts/my-profile-btn.js"></script>

</body>

</html>