<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../db.php';

ob_clean();
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT gs.status, COUNT(*) AS count 
              FROM goals g 
              JOIN goal_status gs ON g.id = gs.goal_id 
              WHERE g.user_id = ? 
              GROUP BY gs.status";

    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);

        $statusCounts = [
            'COMPLETED' => 0,
            'IN_PROGRESS' => 0,
            'ON_HOLD' => 0,
            'MISSED' => 0,
        ];

        foreach ($data as $row) {
            $statusCounts[$row['status']] = $row['count'];
        }

        echo json_encode($statusCounts);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
