<?php
    $username = "root";
    $password = "";
    $dbname = "elie-church";
    $server = "localhost";

    function isConnected(): bool {
        if(isset($_COOKIE["credentials"])) {
            return true;
        }
        return false;
    }
?>