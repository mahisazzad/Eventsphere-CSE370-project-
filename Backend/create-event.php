<?php
session_start();
require 'db.php';

$organizer_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT * FROM events WHERE organizer_id = ?");
$stmt->execute([$organizer_id]);
$events = $stmt->fetchAll();

foreach ($events as $event) {
    echo "<div>";
    echo "<h2>" . htmlspecialchars($event['name']) . "</h2>";
    echo "<p>" . htmlspecialchars($event['description']) . "</p>";
    echo "<p><strong>Location:</strong> " . htmlspecialchars($event['location']) . "</p>";
    echo "<p><strong>Date:</strong> " . $event['date'] . "</p>";
    echo "<a href='edit-event.php?event_id=" . $event['event_id'] . "'>Edit</a> | ";
    echo "<a href='delete-event.php?event_id=" . $event['event_id'] . "'>Delete</a>";
    echo "</div>";
}
?>
