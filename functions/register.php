<?php
include 'db.php';

$createTableQuery = "
CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL,
    password TEXT NOT NULL
)";
$database->exec($createTableQuery);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = strtolower($_POST['register_username']);
    $password = password_hash($_POST['register_password'], PASSWORD_BCRYPT);

    // Check username length and special characters
    if (strlen($username) > 20 || !preg_match('/^[a-zA-Z0-9]+$/', $username)) {
        echo "Invalid username. Please use only alphanumeric characters and keep it under 20 characters.";
    } else {
        // Check if the username already exists
        $existingUserStmt = $database->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $existingUserStmt->bindValue(':username', $username, SQLITE3_TEXT);
        $existingUserResult = $existingUserStmt->execute();
        $userCount = $existingUserResult->fetchArray()[0];

        if ($userCount > 0) {
            echo "Username already exists. Please choose a different username.";
        } else {
            // Insert new user if username doesn't exist
            $stmt = $database->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
            $stmt->bindValue(':username', $username, SQLITE3_TEXT);
            $stmt->bindValue(':password', $password, SQLITE3_TEXT);

            $result = $stmt->execute();

            if ($result) {
                echo "Registration successful!";
            } else {
                echo "Registration failed.";
            }
        }
    }
}
?>
