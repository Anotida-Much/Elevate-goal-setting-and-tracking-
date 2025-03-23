<?php
require_once __DIR__ . '/auth.php';
require_once __DIR__ . '/db.php';

header('Content-Type: application/json'); // Set the content type to JSON

if (!isset($_SESSION['user_id'])) {
  echo json_encode(['status' => 'error', 'message' => 'User not authenticated']);
  exit;
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  // Begin a transaction
  $conn->begin_transaction();

  try {
    // Delete all goals associated with the user
    $stmt = $conn->prepare("DELETE FROM goals WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Delete the user account
    $stmt->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Commit the transaction
    $conn->commit();

    echo json_encode(['status' => 'success', 'message' => 'Account deleted successfully.']);
  } catch (Exception $e) {
    // Rollback the transaction on error
    $conn->rollback();
    echo json_encode(['status' => 'error', 'message' => 'Error deleting account: ' . $e->getMessage()]);
  } finally {
    $stmt->close();
  }

} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
  try {
    $stmt = $conn->prepare("SELECT full_name, username, country, email FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
      $response = [
        'status' => 'success',
        'data' => $user,
      ];
    } else {
      $response = ['status' => 'error', 'message' => 'User not found'];
    }

    echo json_encode($response);
  } catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to retrieve data: ' . $e->getMessage()]);
  } finally {
    $stmt->close();
  }

} elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  try {
    // Parse PUT request data
    $input_data = json_decode(file_get_contents("php://input"), true);

    $full_name = trim($input_data['fullName']);
    $username = trim($input_data['username']);
    $country = trim($input_data['country']);
    $email = trim($input_data['email']);

    // Validate input data
    if (empty($full_name) || empty($username) || empty($country) || empty($email)) {
      echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
      exit;
    }

    // Update user data
    $stmt = $conn->prepare("UPDATE users SET full_name = ?, username = ?, country = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $full_name, $username, $country, $email, $user_id);
    $stmt->execute();

    // Return success response
    echo json_encode(['status' => 'success', 'message' => 'Profile updated successfully.']);
  } catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to update your profile: ' . $e->getMessage()]);
  } finally {
    $stmt->close();
  }

} else {
  echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}

$conn->close();
?>
