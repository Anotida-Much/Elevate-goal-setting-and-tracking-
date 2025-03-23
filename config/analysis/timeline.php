<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../db.php';

ob_clean();
header('Content-Type: application/json');
$user_id = $_SESSION['user_id'];

$query = "SELECT g.starting_date, DATE(gp.updated_at) AS updated_at, gp.progress_percentage
          FROM goals g
          JOIN goal_progress gp ON g.id = gp.goal_id
          WHERE g.user_id = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
