<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';

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

        // Get goal's due date, start date and current status
        $query = "SELECT g.target_date, g.starting_date, gs.status 
                 FROM goals g 
                 LEFT JOIN goal_status gs ON g.id = gs.goal_id 
                 WHERE g.id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $goal_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $goal_data = $result->fetch_assoc();
        $target_date = $goal_data['target_date'];
        $start_date = $goal_data['starting_date'];
        $current_status = $goal_data['status'];

        // Check if goal has started
        $current_date = date('Y-m-d');
        if ($current_date < $start_date) {
            echo json_encode(['status' => 'error', 'message' => 'This goal has not started yet']);
            exit;
        }

        // Determine new status based on progress and due date
        $new_status = $current_status;

        if ($progress_percentage == 100) {
            $new_status = 'COMPLETED';
        } else if ($current_date > $target_date) {
            $new_status = 'MISSED';
        } else if ($completed_tasks > 0) {
            $new_status = 'IN_PROGRESS';
        }

        // Update goal status if it has changed
        if ($new_status !== $current_status) {
            $query = "UPDATE goal_status SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE goal_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("si", $new_status, $goal_id);
            $stmt->execute();
        }

        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    } finally {
        $conn->close();
    }
}
