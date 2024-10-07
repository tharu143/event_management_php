<?php
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../models/userModel.php';

function loginAdmin($username, $password) {
    return verifyUser($username, $password);
}
?>
