<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once "../parts/admin/head.php" ?>
    <title>Connexion Admin - Eglise méthodiste du Togo</title>
</head>
<body>
    <?php
        require_once "credentials.php";
        $form_error = "";
        if(isConnected()) {
            header("Location: admin.php");
        }
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["pseudo"]) && isset($_POST["mot_de_passe"])) {
                $pseudo = $_POST["pseudo"];
                $mot_de_passe = $_POST["mot_de_passe"];
                $mot_de_passe = hash("sha256", $mot_de_passe);
                try {
                    $pdo = new PDO("mysql:dbname=$dbname;host=$server;charset=UTF8", $username, $password);
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $verification = "SELECT * FROM admins WHERE pseudo = :pseudo and mot_de_passe = :mot_de_passe";
                    $sql = $pdo->prepare($verification);
                    $sql->execute([
                        ":pseudo" => $pseudo,
                        ":mot_de_passe" => $mot_de_passe
                    ]);
                    $reponse = $sql->fetch(PDO::FETCH_ASSOC);
                    if($reponse) {
                        // Cookie d'une semaine
                        setcookie("credentials", random_bytes(16) . "-$pseudo#$pseudo", time() + (3600 * 24 * 7));
                        header("Location: admin.php");
                    }
                } catch(Exception $e) {
                    $form_error = "Une erreur s'est produite. Veuillez réessayer plus tard";
                    echo "Une erreur est survenue: " . $e->getMessage();
                }
            } else {
                $form_error = "Veuillez remplir tout le formulaire";
            }
        }
    ?>
    <form method="post" class="form">
        <p class="form__error"><?= $form_error ?></p>
        <label for="pseudo">
            <p>Pseudo</p>
            <input type="text" name="pseudo" id="pseudo" required />
        </label>
        <label for="mot_de_passe">
            <p>Mot de passe</p>
            <input type="text" name="mot_de_passe" id="mot_de_passe" required />
        </label>
        <button type="submit">Se connecter</button>
    </form>
</body>
</html>