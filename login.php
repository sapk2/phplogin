<!-- login.php -->

<?php
session_start();
require_once 'db_conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate credentials (example using PDO, adjust for your database)
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Successful login
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit;
    } else {
        // Invalid credentials
        header("Location: index.php?error=Invalid credentials");
        exit;
    }
}
?>
