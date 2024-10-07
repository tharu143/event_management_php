<?php
session_start(); // Start the session

// Include database connection and Redis connection
require_once __DIR__ . '../../models/db.php'; // Corrected include path
require_once __DIR__ . '../../models/redis.php'; // Corrected include path

// Initialize variables for username and password
$username = "";
$password = "";
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? LIMIT 1");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if user exists
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Check if the password matches (without hashing)
        if ($user['password'] === $password) {
            // Check if the user is an admin
            if ($user['role'] === 'admin') {
                // Set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                // Set Redis session with an expiration time of 1 hour (3600 seconds)
                $redis->set('session_user_' . $user['id'], json_encode($user), 3600);

                // Redirect to the admin dashboard
                header("Location: /taskphp/views/admin/adminDashboard.php");
                exit(); // Ensure no further code is executed
            } else {
                $error = "Access denied: Only admins can log in here.";
            }
        } else {
            $error = "Invalid username or password.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2>Admin Login</h2>
    <div class="text-center mb-4">
        <img src="../css/login.png" alt="Login Image" style="width: 150px; height: 150px; border-radius: 50%;">
    </div>
    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="post" action="">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
</body>
</html>
