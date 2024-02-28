<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SRift</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<?php
$databasePath = './data/database.db';
$db = new SQLite3($databasePath);

if(isset($_GET['id'])) {
    $userId = $db->escapeString($_GET['id']);
    ?>
    <a href="./view_profile.php?id=<?php echo $userId + 1; ?>">
    <button>See next profile</button></a>
    <a href="./report.php?id=<?php echo $userId; ?>">
    <button>Report</button></a>
    <?php
    $query = "SELECT * FROM users WHERE id = '$userId'";
    $result = $db->query($query);

    if($result && $row = $result->fetchArray(SQLITE3_ASSOC)) {
        $username = $row['username'];
        
        echo '<section class="banner">';
        $avatarPath = './data/avatar/' . $username . '.webp';
        if (file_exists($avatarPath)) {
            echo '<h2>' . $username . ' Avatar</h2>';
            echo '<img class="avatar" src="' . $avatarPath . '" alt="User Avatar">';
        } else {
            echo 'no Upload avatar !';
        }
        $bannerPath = './data/banner/' . $username . '.webp';
        if (file_exists($bannerPath)) {
            ?>
            <style>.banner {
            background:url(<?php echo $bannerPath; ?>);
            }</style>
            <?php
        }
        echo '</section>';
        
        echo '<section class="galery">';
        $directory = './data/post/' . $username . '/';
        if (is_dir($directory)) {
            $files = scandir($directory);

            foreach ($files as $file) {
                if ($file != '.' && $file != '..') {
                    echo '<img src="' . $directory . $file . '" alt="User Image">' . PHP_EOL;
                }
            }
        } else {
            echo 'Aucune image trouvée.';
        }
        echo '</section>';
    } else {
        echo 'User not found.';
    }
} else {
    echo 'User ID not provided.';
}

$db->close();
?>
