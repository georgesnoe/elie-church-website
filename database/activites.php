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
    <title>Activités - Eglise méthodiste du Togo</title>
</head>
<body>
    <header class="header">
        <?php include_once "parts/admin/header.php" ?>
    </header>
</body>
</html>