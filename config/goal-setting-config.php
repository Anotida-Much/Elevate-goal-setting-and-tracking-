<?php
require_once __DIR__ . '/db.php'; // Updated to use the correct path
require_once __DIR__ . '/auth.php';
require_once '../config/validation.php';

$user_id = $_SESSION['user_id'];

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input = $_POST;
    $errors = validateInput($input);

    if (count($errors) > 0) {
        echo json_encode(['status' => 'error', 'errors' => $errors]);
        exit;
    }

    try {
        // Insert goal into database
        $goalData = [
            'user_id' => $user_id,
            'goal_name' => $input['goal-name'],
            'goal_category' => $input['goal-category'],
            'goal_description' => $input['goal-description'],
            'target_date' => $input['target-date'],
            'starting_date' => $input['starting-date'],
            'goal_completion_type' => $input['goal-completion-type'],
            'numeric_target' => $input['numeric-target'],
            'starting_value' => $input['starting-value'],
            'unit' => $input['unit']
        ];

        $sql = "INSERT INTO goals (user_id, goal_name, goal_category, goal_description, target_date, starting_date, goal_completion_type, numeric_target, starting_value, unit)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "isssssssds",
            $goalData['user_id'],
            $goalData['goal_name'],
            $goalData['goal_category'],
            $goalData['goal_description'],
            $goalData['target_date'],
            $goalData['starting_date'],
            $goalData['goal_completion_type'],
            $goalData['numeric_target'],
            $goalData['starting_value'],
            $goalData['unit']
        );
        $stmt->execute();
        $goalId = $conn->insert_id;

        // Insert goal status into database
        $sql = "INSERT INTO goal_status (goal_id, status) VALUES (?, 'IN_PROGRESS')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $goalId);
        $stmt->execute();

        // Insert goal progress into database
        $query = "INSERT INTO goal_progress (user_id, goal_id) VALUES(?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ii", $user_id, $goalId);
        $stmt->execute();

        // Get tasks from JSON string and insert into database
        $tasks = json_decode($_POST['tasks'], true);
        $stmt = $conn->prepare("INSERT INTO tasks (goal_id, task_name) VALUES (?, ?)");
        $stmt->bind_param("is", $goalId, $taskName);

        foreach ($tasks as $task) {
            $taskName = $task;
            $stmt->execute();
        }

        $stmt->close();
        $conn->close();

        echo json_encode(['status' => 'success', 'message' => 'Goal set successfully!']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>

