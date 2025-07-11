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
        <?php include_once "../parts/admin/header.php" ?>
    </header>
    <main class="admin-panel">
        <h1 class="admin-panel__title">Panel d'administration</h1>
        <nav class="admin-panel__nav">
            <a href="versets.php" class="admin-panel__link">Versets</a>
            <a href="activites.php" class="admin-panel__link">Activités</a>
            <a href="enseignements.php" class="admin-panel__link">Enseignements</a>
            <a href="admins.php" class="admin-panel__link">Admins</a>
        </nav>
    </main>
</body>
</html>