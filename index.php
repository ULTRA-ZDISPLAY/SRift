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
    session_start();
    if(isset($_SESSION['username'])) {
        ?>
        <section><?php
        echo "<h1>Welcome, {$_SESSION['username']}!</h1>";
        echo '<a href="./functions/logout.php">Logout</a>';
        echo '<a href="./view_profile.php?id='.$_SESSION['user_id'].'">See profile</a>';
        ?>
        </section>
        <section class="banner">
        <?php
        $username = $_SESSION['username'];
        $avatarPath = './data/avatar/' . $username . '.webp';
        if (file_exists($avatarPath)) {
            echo '<h2>Your Avatar</h2>';
            echo '<img class="avatar" src="' . $avatarPath . '" alt="User Avatar">';
        }else {
            echo 'Upload avatar !';
        }
        $bannerPath = './data/banner/' . $username . '.webp';
        if (file_exists($bannerPath)) {
            ?>
            <style>.banner {
            background:url(<?php echo $bannerPath; ?>);
            }</style>
            <?php
        }
        ?>
        </section>
        <section class="galery">
            <?php 
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
            ?>
        </section>
        <section>
            
        <form action="./functions/upload_avatar.php" method="post" enctype="multipart/form-data">
    <label for="avatar">Choose an avatar:</label>
    <input type="file" name="avatar" accept="image/*" required><br>
    <input type="submit" value="Upload Avatar">
</form>
<form action="./functions/upload_banner.php" method="post" enctype="multipart/form-data">
    <label for="banner">Choose an banner:</label>
    <input type="file" name="banner" accept="image/*" required><br>
    <input type="submit" value="Upload banner">
</form>
<form action="./functions/upload_post.php" method="post" enctype="multipart/form-data">
    <label for="post">Choose an image:</label>
    <input type="file" name="post" accept="image/*" required><br>
    <input type="submit" value="Upload Post">
</form>

</section>
        <?php
    } else {
    ?>
    <section>
    <h2>Login</h2>
    <form action="./functions/login.php" method="post">
        <label for="login_username">Username:</label>
        <input type="text" name="login_username" required><br>

        <label for="login_password">Password:</label>
        <input type="password" name="login_password" required><br>

        <button type="submit" value="Login">Login</button>
    </form>
    </section>
<section>
<h2>Register</h2>
    <form action="./functions/register.php" method="post">
        <label for="register_username">Username:</label>
        <input type="text" name="register_username" required><br>

        <label for="register_password">Password:</label>
        <input type="password" name="register_password" required><br>

        <button type="submit" value="Register">Register</button>
    </form>
</section>
   
    <?php
    }
    ?>

</body>
</html>