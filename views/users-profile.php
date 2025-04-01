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
  <link href="../node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="../node_modules/bootstrap-icons/font/bootstrap-icons.css" />
  <link rel="stylesheet" href="../node_modules/aos/dist/aos.css" />
  <!-- Custom CSS -->
  <link rel="stylesheet" href="../assets/css/main.css" />
  <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.min.css">
  <title>Elevate - My Profile</title>
</head>

<body>
  <?php
  include_once '../config/auth.php';
  include_once '../config/db.php';
  include_once 'navbar.php';

  // Fetch user data from the database
  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT full_name, username, country, email FROM users WHERE id = ?");
  $stmt->bind_param("i", $user_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $user = $result->fetch_assoc();
  ?>

  <!-- Main Content -->
  <div class="main-content">
    <main id="main" class="container border border-1 shadow-sm rounded-4 p-2 mb-3 bg-white">
      <div class="container section-title" data-aos="fade-up">
        <h2>My Profile</h2>
        <p>Manage your Account Information and Settings</p>
      </div>

      <section class="section profile text-dark">
        <div class="row">
          <div class="col-xl-4 mb-3">
            <div class="card">
              <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                <h3 id="fullname" class="text-primary"><?= htmlspecialchars($user['full_name']) ?></h3>
                <h5 id="username" class="text-info"><?= htmlspecialchars($user['username']) ?></h5>
              </div>
            </div>
          </div>

          <div class="col-xl-8">
            <div class="card">
              <div class="card-body pt-3">
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
                  <li class="nav-item">
                    <button class="nav-link text-danger" data-bs-toggle="tab" data-bs-target="#profile-delete-account">Delete
                      Account</button>
                  </li>
                </ul>
                <div class="tab-content pt-2">
                  <!-- Profile Overview -->
                  <div class="tab-pane fade show active profile-overview" id="profile-overview">
                    <h4 class="card-title lead"><b>Profile Details</b></h4>
                    <div class="row">
                      <div class="col-md-4 label"><b>Full Name</b></div>
                      <div class="col-md-8 text-primary"><?= htmlspecialchars($user['full_name']) ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 label"><b>Username</b></div>
                      <div class="col-md-8 text-primary"><?= htmlspecialchars($user['username']) ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 label"><b>Country</b></div>
                      <div class="col-md-8 text-primary"><?= htmlspecialchars($user['country']) ?></div>
                    </div>
                    <div class="row">
                      <div class="col-md-4 label"><b>Email</b></div>
                      <div class="col-md-8 text-primary"><?= htmlspecialchars($user['email']) ?></div>
                    </div>
                  </div>

                  <!-- Profile Edit -->
                  <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <form id="profile-edit-form">
                      <div class="row mb-3">
                        <label for="full_name" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="fullName" type="text" class="form-control" id="full_name"
                            value="<?= htmlspecialchars($user['full_name']) ?>" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="user_name" class="col-md-4 col-lg-3 col-form-label">Username</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="username" type="text" class="form-control" id="user_name"
                            value="<?= htmlspecialchars($user['username']) ?>" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="user_country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="country" type="text" class="form-control" id="user_country"
                            value="<?= htmlspecialchars($user['country']) ?>" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="user_email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="email" type="email" class="form-control" id="user_email"
                            value="<?= htmlspecialchars($user['email']) ?>" required>
                        </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary" id="update-profile-btn">Save Changes</button>
                      </div>
                    </form>
                  </div>

                  <!-- Profile Settings -->
                  <div class="tab-pane fade pt-3" id="profile-settings">
                    <form id="profile-settings-form">
                      <div class="row mb-3">
                        <label for="theme-toggle" class="col-md-4 col-lg-3 col-form-label">Theme</label>
                        <div class="col-md-8 col-lg-9">
                          <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="theme-toggle" />
                            <label class="form-check-label" for="theme-toggle" id="theme-toggle-label">Dark Mode</label>
                          </div>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="notifications" class="col-md-4 col-lg-3 col-form-label">Notifications</label>
                        <div class="col-md-8 col-lg-9">
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="goal-progress-notify">
                            <label class="form-check-label" for="goal-progress-notify">Goal Progress
                              Notifications</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="account-security-notify" checked>
                            <label class="form-check-label" for="account-security-notify">Account & Security
                              Notifications</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="engagement-notify" checked>
                            <label class="form-check-label" for="engagement-notify">Engagement & Motivational
                              Notifications</label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="administrative-notify" checked disabled>
                            <label class="form-check-label" for="administrative-notify">Administrative
                              Notifications</label>
                          </div>
                        </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                      </div>
                    </form>
                  </div>

                  <!-- Change Password -->
                  <div class="tab-pane fade pt-3" id="profile-change-password">
                    <form id="profile-change-password-form">
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
                    </form>
                  </div>

                  <!-- Delete Account -->
                  <div class="tab-pane fade pt-3" id="profile-delete-account">
                    <div class="alert alert-danger">
                      <h4 class="alert-heading">Warning!</h4>
                      <p>Deleting your account is permanent and cannot be undone. This action will:</p>
                      <ul>
                        <li>Delete all your goals and progress</li>
                        <li>Remove all your personal information</li>
                        <li>Cancel any active subscriptions</li>
                      </ul>
                      <hr>
                      <p class="mb-0">Please be certain before proceeding.</p>
                    </div>

                    <form id="profile-delete-account-form">
                      <div class="row mb-3">
                        <label for="deletePassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="deletePassword" type="password" class="form-control" id="deletePassword" required>
                        </div>
                      </div>
                      <div class="row mb-3">
                        <label for="deleteConfirm" class="col-md-4 col-lg-3 col-form-label">Type "DELETE" to confirm</label>
                        <div class="col-md-8 col-lg-9">
                          <input name="deleteConfirm" type="text" class="form-control" id="deleteConfirm" required>
                        </div>
                      </div>
                      <div class="text-center">
                        <button type="submit" class="btn btn-danger">Delete Account</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <?php include "footer.php" ?>

    <!-- Vendor Scripts -->
    <script src="/Elevate/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/Elevate/node_modules/aos/dist/aos.js"></script>
    <script src="/Elevate/node_modules/sweetalert2/dist/sweetalert2.min.js"></script>

    <!-- Custom Scripts -->
    <script src="/Elevate/assets/js/main.js"></script>
    <script src="/Elevate/assets/js/profile.js"></script>
    <script src="/Elevate/assets/js/delete-account.js"></script>
  </div>
</body>

</html>