<?php
session_start();

// Lockout check (5 minutes = 300 seconds)
if (isset($_SESSION['lock_time']) && time() - $_SESSION['lock_time'] < 300) {
    echo "Too many failed attempts. Try again later.";
    exit;
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Example correct login (replace with DB check)
    $correct_user = "admin";
    $correct_pass = "1234";

    // Successful login
    if ($username === $correct_user && $password === $correct_pass) {
        $_SESSION['login_attempts'] = 0;
        header("Location: manage.php");
        exit;
    }

    // Failed login
    $_SESSION['login_attempts'] = ($_SESSION['login_attempts'] ?? 0) + 1;

    // Lock after 3 failed attempts
    if ($_SESSION['login_attempts'] >= 3) {
        $_SESSION['lock_time'] = time();
        echo "Account locked for 5 minutes.";
        exit;
    }

    echo "Invalid login.";
}
?>
