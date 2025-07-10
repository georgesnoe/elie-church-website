<!-- This one won't be exposed publically -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once "../parts/admin/head.php" ?>
    <title>Enregistrement Admin - Eglise méthodiste du Togo</title>
</head>
<body>
    <?php
        require_once "credentials.php";
        $form_error = "";
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            if(isset($_POST["pseudo"]) && isset($_POST["nom"]) && isset($_POST["mot_de_passe"]) && isset($_POST["confirmer_le_mot_de_passe"])) {
                $pseudo = $_POST["pseudo"];
                $nom = $_POST["nom"];
                $mot_de_passe = $_POST["mot_de_passe"];
                $confirmer_le_mot_de_passe = $_POST["confirmer_le_mot_de_passe"];
                if($mot_de_passe == $confirmer_le_mot_de_passe) {
                    try {
                        $pdo = new PDO("mysql:dbname=$dbname;host=$server;charset=UTF8", $username, $password);
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $verification = "SELECT * FROM admins WHERE pseudo = :pseudo";
                        $sql = $pdo->prepare($verification);
                        $sql->execute([
                            ":pseudo" => $pseudo
                        ]);
                        $reponse = $sql->fetch();
                        if(!$reponse) {
                            $insertion = "INSERT INTO admins (pseudo, nom, mot_de_passe) VALUES (:pseudo, :nom, :mot_de_passe)";
                            $mot_de_passe = hash("sha256", $mot_de_passe);
                            $sql = $pdo->prepare($insertion);
                            $sql->execute([
                                ":pseudo" => $pseudo,
                                ":nom" => $nom,
                                ":mot_de_passe" => $mot_de_passe
                            ]);
                            if($pdo->lastInsertId()) {
                                // Cookie d'une semaine
                                setcookie("credentials", random_bytes(16) . "-$pseudo#$pseudo", time() + (3600 * 24 * 7));
                                header("Location: admin.php");
                            } else {
                                echo "Une erreur s'est produite";
                            }
                        }
                    } catch(Exception $e) {
                        $form_error = "Une erreur s'est produite. Veuillez réessayer plus tard";
                        echo "Une erreur est survenue: " . $e->getMessage();
                    }
                } else {
                    $form_error = "Les mots de passe ne correspondent pas";
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
        <label for="nom">
            <p>Nom</p>
            <input type="text" name="nom" id="nom" required />
        </label>
        <label for="mot_de_passe">
            <p>Mot de passe</p>
            <input type="password" name="mot_de_passe" id="mot_de_passe" required />
        </label>
        <label for="confirmer_le_mot_de_passe">
            <p>Confirmer le mot de passe</p>
            <input type="password" name="confirmer_le_mot_de_passe" id="confirmer_le_mot_de_passe" required />
        </label>
        <button type="submit">S'enregistrer</button>
    </form>
</body>
</html>