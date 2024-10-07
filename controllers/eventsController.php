<?php
require_once __DIR__ . '/../models/db.php';
require_once __DIR__ . '/../models/eventModel.php';

function createNewEvent($data) {
    return insertEvent($data);
}

function getAllEvents() {
    return fetchAllEvents();
}

function getEventById($id) {
    return fetchEventById($id);
}

function updateEventDetails($id, $data) {
    return updateEvent($id, $data);
}

function deleteEvent($id) {
    return removeEvent($id);
}
?>
