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
     <a href="./view_profile.php?id=<?php echo $userId; ?>">
    <button>See profile</button></a>
    <?php
  
    $query = "SELECT * FROM users WHERE id = '$userId'";
$result = $db->query($query);

if($result && $row = $result->fetchArray(SQLITE3_ASSOC)) {
    $username = $row['username'];
    ?> 
    <section>
    <h1>You have signaled <?php echo $username ?></h1>
    <h2>Dear members of our community,</h2>
    <p>
We would like to remind you of the importance of reporting any illegal content on our platform. Your safety and respect for the law are our top priorities. If you identify any behavior or content in violation of the law, please do not hesitate to report it immediately.
<br>
However, we believe in diversity of opinion and freedom of expression. We encourage an environment where everyone can share their ideas and experiences. Therefore, please note that we will only take action against reported illegal content.<br>
Thank you for helping to make our community a safe and respectful place for everyone.<br>
Stay connected, stay positive! <br>
</p>
    <?php
}
}

?>
</section>