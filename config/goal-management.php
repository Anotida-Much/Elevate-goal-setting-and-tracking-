<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';  

// Check authentication
if (!isset($_SESSION['username'])) {
    respondWithError('Unauthorized');
    exit;
}

// Validate input
$action = $_POST['action'] ?? null;
$goalId = $_POST['goalId'] ?? null;

if (!$action || !$goalId || !filter_var($goalId, FILTER_VALIDATE_INT)) {
    respondWithError('Invalid action');
    exit;
}

// Define allowed actions
$allowedActions = ['pause', 'mark-complete', 'resume', 'missed', 'delete'];

if (!in_array($action, $allowedActions)) {
    respondWithError('The selected option is still work in progress. We are sorry for the inconvenience caused.');
    exit;
}

// Prepare database query
$stmt = $conn->prepare(getQuery($action, $goalId));
$stmt->bind_param("i", $goalId);

if (!$stmt->execute()) {
    respondWithError('Database query failed: ' . $stmt->error);
    exit;
}

// Handle query result
handleQueryResult($stmt, $action);

// Helper functions
function respondWithError($error)
{
    echo json_encode(['success' => false, 'error' => $error]);
    exit;
}

function getQuery($action, $goalId)
{
    switch ($action) {
        case 'mark-complete':
            return "UPDATE goal_status SET status = 'COMPLETED' WHERE goal_id = ?";
        case 'pause':
            return "UPDATE goal_status SET status = 'ON_HOLD' WHERE goal_id = ?";
        case 'resume':
            return "UPDATE goal_status SET status = 'IN_PROGRESS' WHERE goal_id = ?";
        case 'delete':
            return "DELETE FROM goals WHERE id = ?";
        case 'missed':
            return "UPDATE goal_status SET status = 'MISSED' WHERE goal_id = ?";
    }
}

function handleQueryResult($stmt, $action)
{
    if ($stmt->affected_rows > 0) {
        respondWithSuccess(getSuccessMessage($action));
    } elseif ($stmt->affected_rows === 0) {
        respondWithSuccess(getAlreadyDoneMessage($action));
    } else {
        respondWithError('Unknown database error');
    }
}

function respondWithSuccess($message)
{
    echo json_encode(['success' => true, 'message' => $message]);
    exit;
}

function getSuccessMessage($action)
{
    switch ($action) {
        case 'mark-complete':
            return 'Goal marked as complete';
        case 'pause':
            return 'Goal paused';
        case 'resume':
            return 'Goal resumed';
        case 'delete':
            return 'Goal deleted';
        case 'missed':
            return "Goal marked as missed. <br> We are sorry to hear that you missed your goal";
    }
}

function getAlreadyDoneMessage($action)
{
    switch ($action) {
        case 'mark-complete':
            return 'Goal already marked as complete';
        case 'missed':
            return 'Goal already marked as missed. Again we are sorry to hear that you missed your goal';
        case 'pause':
            return 'Goal already paused';
        case 'delete':
            return 'Goal not found';
    }
}
