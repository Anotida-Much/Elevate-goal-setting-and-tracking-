<?php
require_once 'db.php';
require_once 'auth.php';

// Edit note endpoint
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  $id = $_GET['id'];
  $userId = $_SESSION['user_id'];
  $jsonData = file_get_contents('php://input');
  $noteData = json_decode($jsonData, true);

  if (!$noteData) {
    echo json_encode(['error' => 'Invalid JSON data']);
    http_response_code(400);
    return;
  }

  $title = $noteData['title'];
  $content = json_encode($noteData['content']);

  $sql = "UPDATE notes SET title = ?, content = ? WHERE id = ? AND user_id = ?";
  $stmt = $conn->prepare($sql);

  if (!$stmt) {
    echo json_encode(['error' => 'Database error: ' . $conn->error]);
    http_response_code(500);
    return;
  }

  $stmt->bind_param("ssii", $title, $content, $id, $userId);
  $stmt->execute();

  if ($stmt->affected_rows === 0) {
    echo json_encode(['error' => 'Note not found']);
    http_response_code(404);
    return;
  }

  echo json_encode(['message' => 'Note updated successfully']);
  http_response_code(200);
}
