<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/auth.php';

function validateInput($input)
{
    $errors = array();

    // Check for empty fields
    if (empty($input['goal-name'])) {
        $errors[] = "Goal name is required.";
    }
    if (empty($input['goal-category'])) {
        $errors[] = "Goal category is required.";
    }
    if (empty($input['goal-description'])) {
        $errors[] = "Goal description is required.";
    }
    if (empty($input['target-date'])) {
        $errors[] = "Target date is required.";
    }
    if (empty($input['starting-date'])) {
        $errors[] = "Starting date is required.";
    }

    // Check date formats
    if (!preg_match("/\d{4}-\d{2}-\d{2}/", $input['target-date'])) {
        $errors[] = "Invalid target date format. Use YYYY-MM-DD.";
    }
    if (!preg_match("/\d{4}-\d{2}-\d{2}/", $input['starting-date'])) {
        $errors[] = "Invalid starting date format. Use YYYY-MM-DD.";
    }

    // Check numeric values


    return $errors;
}

function handleError($error)
{
    echo "<p style='color: red;'>$error</p>";
}
