<?php
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../models/userModel.php';

function createUser($data) {
    return insertUser($data);
}

function getAllUsers() {
    return fetchAllUsers();
}
?>
