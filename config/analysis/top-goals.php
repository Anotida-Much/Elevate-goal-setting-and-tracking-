<?php
require_once '../auth.php';
require_once '../db.php';

ob_clean();
header('Content-Type: application/json');

$user_id = $_SESSION['user_id'];
$limit = 5;

$query = "SELECT goal_name, progress_percentage
          FROM goals
          JOIN goal_progress ON goals.id = goal_progress.goal_id
          WHERE goal_progress.user_id = ?
          ORDER BY progress_percentage DESC
          LIMIT ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $limit);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
