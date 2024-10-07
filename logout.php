<?php
// Ensure the correct absolute path to the redis.php file
require_once __DIR__ . '../models/redis.php'; // Update this to the actual full path to redis.php

session_start();
$sessionKey = 'user_session_' . $_SESSION['user_id'];

// Clear the session from Redis
$redis->del($sessionKey);

// Destroy PHP session
session_destroy();

// Redirect to the login page
header("Location: index.php");
exit();
?>
