<?php
require_once __DIR__ . '/db.php';

function insertUser($data) {
    global $conn; // Use global connection
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    return $stmt->execute([$data['username'], password_hash($data['password'], PASSWORD_DEFAULT)]);
}

function fetchAllUsers() {
    global $conn; // Use global connection
    $stmt = $conn->query("SELECT * FROM users");
    return $stmt->fetch_all(MYSQLI_ASSOC);
}

function verifyUser($username, $password) {
    global $conn; // Use global connection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        return $user['id']; // Return user ID on successful login
    }
    return false; // Return false on failed login
}
?>
