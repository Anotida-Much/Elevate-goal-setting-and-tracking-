<?php
require_once 'db.php';
require_once 'auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
  $id = $_GET['id'];
  $userId = $_SESSION['user_id'];

  $sql = "SELECT * FROM notes WHERE id = ? AND user_id = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ii", $id, $userId);
  $stmt->execute();
  $result = $stmt->get_result();
  $note = $result->fetch_assoc();


  echo json_encode(['id' => $note['id'], 'title' => $note['title'], 'content' => json_decode($note['content'], true)]);
  //Decode Delta format
}
