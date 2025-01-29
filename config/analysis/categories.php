<?php
require_once '../auth.php';
require_once '../db.php';

ob_clean();
header('Content-Type: application/json');
$user_id = $_SESSION['user_id'];

$query = "SELECT goal_category, 
        COUNT(id) AS category_count 
        FROM goals WHERE user_id = ?
        GROUP BY goal_category";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$chartData = array();
while ($row = $result->fetch_assoc()) {
    $chartData[] = $row;
}

echo json_encode($chartData);

$conn->close();
