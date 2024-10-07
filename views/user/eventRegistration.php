<?php
require_once __DIR__ . '/../../models/redis.php';
require_once __DIR__ . '/../controllers/eventsController.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: userLogin.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    registerForEvent($_POST['event_id'], $_SESSION['user_id']);
    header('Location: eventList.php');
    exit();
}

$events = getAllEvents();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Event Management</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="eventList.php">Events</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../../logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>Event Registration</h1>
        <form method="POST">
            <div class="form-group">
                <label for="event">Select Event</label>
                <select class="form-control" id="event" name="event_id" required>
                    <?php foreach ($events as $event): ?>
                        <option value="<?php echo $event['id']; ?>"><?php echo $event['event_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
