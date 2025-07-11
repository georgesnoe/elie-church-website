<?php
    require_once "credentials.php";
    if(!isConnected()) {
        header("Location: login.php");
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once "../parts/admin/head.php" ?>
    <title>Admin - Eglise méthodiste du Togo</title>
</head>
<body>
    <header class="header">
        <?php include_once "parts/admin/header.php" ?>
    </header>
    <h1>Panel d'administration</h1>
    <a href="versets.php">Versets</a>
    <a href="activites.php">Activités</a>
    <a href="enseignements.php">Enseignements</a>
    <a href="admins.php">Admins</a>
</body>
</html>