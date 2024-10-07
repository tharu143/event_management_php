<?php
$redis = new Redis();
try {
    $redis->connect('127.0.0.1', 6379); // Connect to Redis
} catch (Exception $e) {
    echo "Could not connect to Redis: " . $e->getMessage();
    exit;
}
?>
