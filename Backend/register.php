<?php
include 'db.php';  // Include database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = 'attendee';  // Default role

    // Hash the password for security
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Prepare SQL query to insert new user into the database
    $stmt = $pdo->prepare("INSERT INTO users (full_name, email, password_hash, role) VALUES (?, ?, ?, ?)");
    if ($stmt->execute([$full_name, $email, $password_hash, $role])) {
        echo "User registered successfully.";
    } else {
        echo "Error: Could not register.";
    }
}
?>

<form method="POST" action="">
    Full Name: <input type="text" name="full_name" required><br>
    Email: <input type="email" name="email" required><br>
    Password: <input type="password" name="password" required><br>
    <input type="submit" value="Register">
</form>
