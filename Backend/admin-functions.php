<?php
session_start();
require 'db.php';

if ($_SESSION['role'] !== 'admin') {
    die("Access denied.");
}

// View all users
$stmt = $pdo->query("SELECT user_id, full_name, email, role FROM users");
$users = $stmt->fetchAll();

echo "<h2>Users</h2>";
foreach ($users as $user) {
    echo "<div>";
    echo "<p>ID: " . $user['user_id'] . "</p>";
    echo "<p>Name: " . htmlspecialchars($user['full_name']) . "</p>";
    echo "<p>Email: " . htmlspecialchars($user['email']) . "</p>";
    echo "<p>Role: " . $user['role'] . "</p>";
    echo "</div>";
}

// View all events
$stmt = $pdo->query("SELECT e.event_id, e.name, e.date, u.full_name AS organizer_name
                     FROM events e
                     JOIN users u ON e.organizer_id = u.user_id");
$events = $stmt->fetchAll();

echo "<h2>Events</h2>";
foreach ($events as $event) {
    echo "<div>";
    echo "<p>ID: " . $event['event_id'] . "</p>";
    echo "<p>Name: " . htmlspecialchars($event['name']) . "</p>";
    echo "<p>Date: " . $event['date'] . "</p>";
    echo "<p>Organizer: " . htmlspecialchars($event['organizer_name']) . "</p>";
    echo "</div>";
}
?>
