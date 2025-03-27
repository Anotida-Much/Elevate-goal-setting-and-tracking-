<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once 'config/config.php';
require_once 'config/db.php';

echo "<h1>Database Connection Test</h1>";

if ($conn->connect_error) {
    echo "<p style='color: red;'>Connection failed: " . $conn->connect_error . "</p>";
} else {
    echo "<p style='color: green;'>Database connection successful!</p>";
    
    // Test if tables exist
    $tables = ['users', 'goals', 'goal_progress', 'goal_status', 'notes', 'tasks'];
    echo "<h2>Checking Database Tables:</h2>";
    foreach ($tables as $table) {
        $result = $conn->query("SHOW TABLES LIKE '$table'");
        if ($result->num_rows > 0) {
            echo "<p style='color: green;'>✓ Table '$table' exists</p>";
        } else {
            echo "<p style='color: red;'>✗ Table '$table' does not exist</p>";
        }
    }
}

$conn->close();
?> 