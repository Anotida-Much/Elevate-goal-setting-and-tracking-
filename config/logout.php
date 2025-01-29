<?php
ob_start();
    session_start();
        // unset all session variables
        session_unset();
        // destroy the session
        session_destroy();

        header('Location: ../login.php');
    ob_end_flush(); 
    exit;