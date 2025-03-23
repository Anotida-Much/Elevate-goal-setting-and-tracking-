<?php
require_once __DIR__ . '/auth.php';
ob_start();
    session_start();
        // unset all session variables
        session_unset();
        // destroy the session
        session_destroy();

        header('Location: ../views/login.php'); // Updated to point to the correct login page
    ob_end_flush(); 
    exit;