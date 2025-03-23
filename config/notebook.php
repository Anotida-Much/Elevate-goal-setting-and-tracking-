<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    echo json_encode(['error' => 'User not authenticated']);
    exit;
}

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
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $sql = "SELECT * FROM notes WHERE id = ? AND user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $id, $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $note = $result->fetch_assoc();

            if ($note) {
                echo json_encode([
                    'id' => $note['id'],
                    'title' => $note['title'],
                    'content' => json_decode($note['content'], true)
                ]);
            } else {
                http_response_code(404);
                echo json_encode(['error' => 'Note not found']);
            }
        } else {
            $sql = "SELECT id, title, content FROM notes WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $userId);
            $stmt->execute();
            $result = $stmt->get_result();
            $notes = [];

            while ($note = $result->fetch_assoc()) {
                $note['content'] = json_decode($note['content'], true);
                $notes[] = $note;
            }

            echo json_encode($notes);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $id = $_GET['id'];
        $jsonData = file_get_contents('php://input');
        $noteData = json_decode($jsonData, true);

        if (!$noteData) {
            throw new Exception('Invalid JSON data');
        }

        $title = $noteData['title'];
        $content = json_encode($noteData['content']);

        $sql = "UPDATE notes SET title = ?, content = ? WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssii", $title, $content, $id, $userId);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Note not found']);
        } else {
            echo json_encode(['message' => 'Note updated successfully']);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $id = $_GET['id'];

        $sql = "DELETE FROM notes WHERE id = ? AND user_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $id, $userId);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            http_response_code(404);
            echo json_encode(['error' => 'Note not found']);
        } else {
            echo json_encode(['message' => 'Note deleted successfully']);
        }
    } else {
        throw new Exception('Invalid request method');
    }
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['error' => $e->getMessage()]);
}
?>