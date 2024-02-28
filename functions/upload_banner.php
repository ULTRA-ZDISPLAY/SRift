<?php
session_start();

if (isset($_SESSION['username']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_SESSION['username'];
    $targetDirectory = '../data/banner/';
    $targetFile = $targetDirectory . $username . '.webp'; 

    $uploadOk = 1;

    if ($_FILES['banner']['size'] > 500000) {
        echo 'Désolé, le fichier est trop volumineux.';
        $uploadOk = 0;
    }
    if ($uploadOk == 0) {
        echo 'Désolé, votre fichier n\'a pas été téléchargé.';
    } else {
        if (move_uploaded_file($_FILES['banner']['tmp_name'], $targetFile)) {
            echo 'La banner a été téléchargé avec succès.';
        } else {
            echo 'Désolé, une erreur s\'est produite lors du téléchargement de votre fichier.';
        }
    }
} else {
    echo 'Accès non autorisé.';
}
?>
