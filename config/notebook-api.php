<?php
require_once 'db.php';
require_once 'auth.php';

header('Content-Type: application/json');

$userId = $_SESSION['user_id'];

try {
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents('php://input');
    $noteData = json_decode($jsonData, true);

    if (!isset($noteData['title']) || !isset($noteData['content'])) {
      throw new Exception('Invalid input');
    }

    $title = $noteData['title'];
    $content = json_encode($noteData['content']);

    $sql = "INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $userId, $title, $content);

    if ($stmt->execute()) {
      echo json_encode(['message' => 'Note created successfully']);
    } else {
      throw new Exception('Failed to create note');
    }
  } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $sql = "SELECT id, title, content FROM notes WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    $notes = array();

    while ($note = $result->fetch_assoc()) {
      $note['content'] = json_decode($note['content'], true); // Decode content from JSON
      $notes[] = $note;
    }

    echo json_encode($notes);
  } else {
    throw new Exception('Invalid request method');
  }
} catch (Exception $e) {
  http_response_code(400);
  echo json_encode(['error' => $e->getMessage()]);
}
?>
