<?php
require_once 'db.php';
require_once 'auth.php';


// Delete note endpoint
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  $id = $_GET['id'];

  $sql = "DELETE FROM notes WHERE id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $id);
  $stmt->execute();

  if ($stmt->affected_rows === 0) {
    echo json_encode(['error' => 'Note not found']);
    http_response_code(404);
    return;
  }

  echo json_encode(['message' => 'Note deleted successfully']);
  http_response_code(200);
}
