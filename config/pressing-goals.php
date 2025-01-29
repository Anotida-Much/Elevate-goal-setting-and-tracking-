<?php
// Configuration
require_once 'db.php';
require_once 'auth.php';

// Get the user ID (assuming it's stored in a session variable)
$user_id = $_SESSION['user_id'];

// Prepare the SQL query
$stmt = $conn->prepare("SELECT 
                            g.id, 
                            g.goal_name, 
                            g.goal_description, 
                            g.target_date, 
                            g.goal_category, 
                            gp.progress_percentage, 
                            gs.status
                        FROM  goals g 
                        LEFT JOIN 
                            goal_progress gp ON g.id = gp.goal_id
                        LEFT JOIN 
                            goal_status gs ON g.id = gs.goal_id
                        WHERE 
                            g.user_id = ? AND 
                            gs.status = 'IN_PROGRESS'
                        ORDER BY 
                            g.target_date ASC
                        LIMIT 3");

// Bind the user ID parameter
$stmt->bind_param("i", $user_id);

// Execute the query and get the result
$stmt->execute();
$result = $stmt->get_result();

// Array to store the data
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$conn->close();
return $data;
