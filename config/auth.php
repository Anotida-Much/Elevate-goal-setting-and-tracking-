<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/db.php';

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: ../views/login.php');
    exit;
}


