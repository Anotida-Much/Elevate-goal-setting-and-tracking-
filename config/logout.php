<?php
require_once __DIR__ . '/auth.php';
ob_start();
    session_start();
        // unset all session variables
        session_unset();
        // destroy the session
        session_destroy();

        header('Location: ../index.php');
    ob_end_flush(); 
    exit;