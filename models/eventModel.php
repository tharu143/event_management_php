<?php
require_once __DIR__ . '/db.php';

function insertEvent($data) {
    global $conn; // Use global connection
    $stmt = $conn->prepare("INSERT INTO events (title, description, event_date, event_time) VALUES (?, ?, ?, ?)");
    return $stmt->execute([$data['title'], $data['description'], $data['event_date'], $data['event_time']]);
}

function fetchAllEvents() {
    global $conn; // Use global connection
    $stmt = $conn->query("SELECT * FROM events");
    return $stmt->fetch_all(MYSQLI_ASSOC);
}

function fetchEventById($id) {
    global $conn; // Use global connection
    $stmt = $conn->prepare("SELECT * FROM events WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function updateEvent($id, $data) {
    global $conn; // Use global connection
    $stmt = $conn->prepare("UPDATE events SET title = ?, description = ?, event_date = ?, event_time = ? WHERE id = ?");
    return $stmt->execute([$data['title'], $data['description'], $data['event_date'], $data['event_time'], $id]);
}

function removeEvent($id) {
    global $conn; // Use global connection
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    return $stmt->execute([$id]);
}
?>
