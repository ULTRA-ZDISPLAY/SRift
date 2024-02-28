<?php
session_start();

if (isset($_SESSION['username']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $targetDirectory = '../data/post/' . $username . '/';
    $extension = pathinfo($_FILES['post']['name'], PATHINFO_EXTENSION);
    $uniqueNumber = rand(100000000, 999999999);
    $targetFile = $targetDirectory . $uniqueNumber . '.' . $extension;

    $uploadOk = 1;

    if ($_FILES['post']['size'] > 500000) {
        echo 'Désolé, le fichier est trop volumineux.';
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo 'Désolé, votre fichier n\'a pas été téléchargé.';
    } else {
        if (!is_dir($targetDirectory) && !mkdir($targetDirectory, 0777, true)) {
            die('Failed to create directory.');
        }

        if (move_uploaded_file($_FILES['post']['tmp_name'], $targetFile)) {
            echo 'Le post a été téléchargée avec succès.';
        } else {
            echo 'Désolé, une erreur s\'est produite lors du téléchargement de votre fichier.';
        }
    }
} else {
    echo 'Accès non autorisé.';
}
?>
