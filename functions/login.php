<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = strtolower($_POST['login_username']);
    $password = $_POST['login_password'];

    $stmt = $database->prepare("SELECT id, username, password FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username, SQLITE3_TEXT);

    $result = $stmt->execute();
    $row = $result->fetchArray(SQLITE3_ASSOC);

    if ($row && password_verify($password, $row['password'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        echo "Login successful! Welcome, " . $row['username'];
        header("Location: ../index.php");
        exit;
    } else {
        echo "Login failed. Invalid username or password.";
    }
}
?>
