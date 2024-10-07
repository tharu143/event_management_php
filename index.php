<?php
session_start(); // Start the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Event Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5 text-center">
    <h1>Welcome to Event Management</h1>
    <p class="lead">Please choose your login type:</p>
    <div class="mt-4">
        <a href="views/login.php" class="btn btn-primary btn-lg">Admin Login</a>
        <a href="views/user/userLogin.php" class="btn btn-secondary btn-lg">User Login</a>
    </div>
</div>
</body>
</html>
