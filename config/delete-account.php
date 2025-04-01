<?php
session_start();
require_once 'db.php';
require_once 'auth.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

// Get POST data
$data = json_decode(file_get_contents('php://input'), true);
$password = $data['password'] ?? '';

if (empty($password)) {
    echo json_encode(['status' => 'error', 'message' => 'Password is required']);
    exit;
}

// Verify password
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT password FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || !password_verify($password, $user['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
    exit;
}

// Begin transaction to delete all user data
$conn->begin_transaction();

try {
    // Delete user's goals
    $stmt = $conn->prepare("DELETE FROM goals WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Delete user's tasks
    $stmt = $conn->prepare("DELETE FROM tasks WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Delete user's notes
    $stmt = $conn->prepare("DELETE FROM notes WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Finally, delete the user account
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Commit transaction
    $conn->commit();

    // Clear session
    session_destroy();

    echo json_encode(['status' => 'success', 'message' => 'Account deleted successfully']);
} catch (Exception $e) {
    // Rollback transaction on error
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete account: ' . $e->getMessage()]);
}

$conn->close(); 