<?php
session_start();
require_once __DIR__ . '/../../models/db.php';// Include the database connection
require_once __DIR__ . '/../../models/redis.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: userLogin.php');
    exit();
}

// Get the event ID and the action (accept/reject)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $event_id = $_POST['event_id'];
    $action = $_POST['action'];
    $user_id = $_SESSION['user_id'];

    // Insert or update the user's participation status for the event
    if ($action === "accept") {
        $stmt = $conn->prepare("INSERT INTO event_participation (user_id, event_id, status) VALUES (?, ?, 'accepted') 
                                ON DUPLICATE KEY UPDATE status='accepted'");
    } else {
        $stmt = $conn->prepare("INSERT INTO event_participation (user_id, event_id, status) VALUES (?, ?, 'rejected') 
                                ON DUPLICATE KEY UPDATE status='rejected'");
    }

    $stmt->bind_param("ii", $user_id, $event_id);
    $stmt->execute();
    
    // Redirect back to the event list
    header("Location: eventList.php");
    exit();
}
