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
    <title>Admins - Eglise méthodiste du Togo</title>
</head>
<body>
    
</body>
</html>