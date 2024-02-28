<link rel="stylesheet" href="../css/style.css">
<?php
$database = new SQLite3('../data/database.db');

if (!$database) {
    die("Connection failed: " . $database->lastErrorMsg());
}
?>
