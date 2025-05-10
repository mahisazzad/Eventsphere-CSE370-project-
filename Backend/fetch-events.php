<?php
include 'db.php';

$stmt = $pdo->prepare("SELECT * FROM events");
$stmt->execute();
$events = $stmt->fetchAll();

foreach ($events as $event) {
    echo "<div>";
    echo "<h2>" . htmlspecialchars($event['name']) . "</h2>";
    echo "<p>" . htmlspecialchars($event['description']) . "</p>";
    echo "<p><strong>Location:</strong> " . htmlspecialchars($event['location']) . "</p>";
    echo "<p><strong>Date:</strong> " . $event['date'] . "</p>";
    echo "<a href='event-details.php?event_id=" . $event['event_id'] . "'>View Event</a>";
    echo "</div>";
}
?>
