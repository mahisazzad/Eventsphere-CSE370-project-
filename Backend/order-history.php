<?php
session_start();
require 'db.php';

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("
    SELECT o.order_id, e.name AS event_name, t.ticket_type, o.purchase_date
    FROM orders o
    JOIN tickets t ON o.ticket_id = t.ticket_id
    JOIN events e ON t.event_id = e.event_id
    WHERE o.user_id = ?
    ORDER BY o.purchase_date DESC
");
$stmt->execute([$user_id]);
$orders = $stmt->fetchAll();

foreach ($orders as $order) {
    echo "<div>";
    echo "<h3>" . htmlspecialchars($order['event_name']) . "</h3>";
    echo "<p>Ticket Type: " . htmlspecialchars($order['ticket_type']) . "</p>";
    echo "<p>Purchase Date: " . $order['purchase_date'] . "</p>";
    echo "</div>";
}
?>
