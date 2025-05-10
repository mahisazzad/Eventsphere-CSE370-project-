<?php
session_start();  // Start the session to access user data

include 'db.php';  // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $ticket_id = $_POST['ticket_id'];

    // Check if the ticket exists
    $stmt = $pdo->prepare("SELECT * FROM tickets WHERE ticket_id = ?");
    $stmt->execute([$ticket_id]);
    $ticket = $stmt->fetch();

    if ($ticket) {
        // Insert the order into the orders table
        $stmt = $pdo->prepare("INSERT INTO orders (user_id, ticket_id) VALUES (?, ?)");
        $stmt->execute([$user_id, $ticket_id]);

        echo "Ticket purchased successfully!";
    } else {
        echo "Ticket not found.";
    }
} else {
    echo "You need to be logged in to purchase a ticket.";
}
?>

<form method="POST" action="">
    Ticket ID: <input type="text" name="ticket_id" required><br>
    <input type="submit" value="Purchase Ticket">
</form>
