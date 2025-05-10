<?php
$host = 'localhost';
$dbname = 'eventsphere';
$username = 'root';  // Default MySQL username
$password = '';      // Default MySQL password (leave empty if none)

try {
    // Connect to the database using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
