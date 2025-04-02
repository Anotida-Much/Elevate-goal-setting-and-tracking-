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

$query = "SELECT password FROM users WHERE id = ?";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user || !password_verify($password, $user['password'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid password']);
    exit;
}

// Begin transaction to delete all user data
mysqli_begin_transaction($conn);

try {
    // Delete user's goals
    $query = "DELETE FROM goals WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    // Delete user's notes
    $query = "DELETE FROM notes WHERE user_id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    // Finally, delete the user account
    $query = "DELETE FROM users WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);

    // Commit transaction
    mysqli_commit($conn);

    // Clear session
    session_destroy();

    echo json_encode(['status' => 'success', 'message' => 'Account deleted successfully']);
} catch (Exception $e) {
    // Rollback transaction on error
    mysqli_rollback($conn);
    echo json_encode(['status' => 'error', 'message' => 'Failed to delete account: ' . $e->getMessage()]);
}

mysqli_close($conn);