<?php
require_once 'db.php';
require_once 'auth.php';


$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $jsonData = file_get_contents('php://input');
  $noteData = json_decode($jsonData, true);
  $title = $noteData['title'];
  $content = json_encode($noteData['content']);


  $sql = "INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("iss", $userId, $title, $content);
  $stmt->execute();

  echo json_encode(['message' => 'Note  created successfully']);
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
  // Returns notes data as JSON Object
  echo json_encode($notes);
}
