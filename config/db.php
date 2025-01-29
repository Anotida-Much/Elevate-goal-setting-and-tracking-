<?php

require_once 'config.php';

    // Establish database connection
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    // Check connection
    
    if ($conn->connect_error) {
        // Log error to a file
        error_log("Database connection error: " . $conn->connect_error, 3, LOG_FILE);

        // Display user-friendly error message
        die("An error occurred while connecting to the database. Please try again later.");
    }

