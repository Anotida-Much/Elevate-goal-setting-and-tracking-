<?php

// Database configuration
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'elevate');

// Error reporting
define('ERROR_REPORTING', getenv('ERROR_REPORTING') ?: 'E_ALL & ~E_NOTICE');

// Log file
define('LOG_FILE', getenv('LOG_FILE') ?: 'error.log');
