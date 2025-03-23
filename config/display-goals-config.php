<?php
// Include authentication and configuration files
require_once '../config/auth.php';
require_once '../config/db.php';  

$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$user_id = $row['id'];

$stmt = $conn->prepare("SELECT * FROM goals WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $goals = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $goals = array();
    echo '
        <div class="col-md-8 offset-md-2 text-light mx-auto mt-3" data-aos="fade-up">
          <div class="alert alert-primary bg-primary alert-dismissible fade show" role="alert">
              <h4 class="alert-heading text-light">Elevate</h4>
              <p class="text-light lead"> You haven\'t set any goals yet. Get started by setting your first goal!</p>
              <hr class="text-light">
              <a href="../views/goal-setting.php" id="no-goal-alert-btn" class="text-light border rounded border-light py-2 px-3">Set Your First Goal</a> <!-- Updated path -->
          </div>
        </div>
    ';
}

$goal_data = array();

foreach ($goals as $goal) {
    $goal_id = $goal['id'];
    $query = "SELECT * FROM tasks WHERE goal_id = '$goal_id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $tasks = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $tasks = array();
    }
    $query = "SELECT * FROM goal_status WHERE goal_id = '$goal_id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $goal_status = $row['status'];
        $goal_update_time = $row['updated_at'];
    } else {
        $goal_status = "Status: Unknown";
    }
    $goal_data[] = array(
        'goal' => $goal,
        'tasks' => $tasks,
        'goal_status' => $goal_status,
        'time' => $goal_update_time
    );
}

$conn->close();
