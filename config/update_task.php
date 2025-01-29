<?php
require_once 'auth.php';
require_once 'db.php';

header('Content-Type: application/json'); // Set the content type to JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $task_id = $_POST['task_id'];
    $user_id = $_SESSION['user_id'];
    $completed = $_POST['completed'] ? 1 : 0;

    try {
        // Retrieve the goal_id from the tasks table
        $query = "SELECT goal_id FROM tasks WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $task_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $goal_id = $result->fetch_assoc()['goal_id'];

        // Update the tasks table
        $query = "UPDATE tasks SET completed = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $completed, $task_id);
        $stmt->execute();

        // Calculate the progress percentage
        $query = "SELECT COUNT(id) AS total_tasks FROM tasks WHERE goal_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $goal_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $total_tasks = $result->fetch_assoc()['total_tasks'];

        $query = "SELECT COUNT(id) AS completed_tasks FROM tasks WHERE goal_id = ? AND completed = 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $goal_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $completed_tasks = $result->fetch_assoc()['completed_tasks'];

        $progress_percentage = ($total_tasks > 0) ? ($completed_tasks / $total_tasks) * 100 : 0;

        // Update the goal_progress table
        $query = "UPDATE goal_progress
                SET progress_percentage = ?
                WHERE goal_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $progress_percentage, $goal_id);
        $stmt->execute();

        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        $conn->close();
    }
}
