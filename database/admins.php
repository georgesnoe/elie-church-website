<?php
    require_once "credentials.php";
    if(!isConnected()) {
        header("Location: login.php");
    }
    try {
        $pdo = new PDO("mysql:dbname=$dbname;host=$server;charset=UTF8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
    // CRUD operations
    // Create
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
        $stmt = $pdo->prepare("INSERT INTO admins (nom, pseudo, mot_de_passe) VALUES (?, ?, ?)");
        $stmt->execute([
            $_POST['nom'],
            $_POST['pseudo'],
            hash('sha256', $_POST['mot_de_passe'])
        ]);
    }
    // Delete
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $stmt = $pdo->prepare("DELETE FROM admins WHERE id = ?");
        $stmt->execute([$id]);
    }
    // Update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $id = intval($_POST['id']);
        $fields = [$_POST['nom'], $_POST['pseudo']];
        $sql = "UPDATE admins SET nom = ?, pseudo = ?";
        if (!empty($_POST['mot_de_passe'])) {
            $sql .= ", mot_de_passe = ?";
            $fields[] = hash('sha256', $_POST['mot_de_passe']);
        }
        $sql .= " WHERE id = ?";
        $fields[] = $id;
        $stmt = $pdo->prepare($sql);
        $stmt->execute($fields);
    }
    // Fetch all
    $stmt = $pdo->query("SELECT * FROM admins ORDER BY id DESC");
    $admins = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once "../parts/admin/head.php" ?>
    <title>Admins - Eglise méthodiste du Togo</title>
</head>
<body>
    <header class="header">
        <?php include_once "../parts/admin/header.php" ?>
    </header>
    <main class="admins-panel">
        <h1 class="admins-panel__title">Gestion des administrateurs</h1>
        <form class="admins-panel__form" method="POST">
            <input type="text" name="nom" class="admins-panel__input" placeholder="Nom" required />
            <input type="text" name="pseudo" class="admins-panel__input" placeholder="Pseudo" required />
            <input type="password" name="mot_de_passe" class="admins-panel__input" placeholder="Mot de passe" required />
            <button type="submit" name="add" class="admins-panel__btn">Ajouter</button>
        </form>
        <section class="admins-panel__list">
            <?php foreach($admins as $row): ?>
                <div class="admins-panel__item" onclick="toggleActions(this)">
                    <div class="admins-panel__info">
                        <div class="admins-panel__nom">Nom: <?= htmlspecialchars($row['nom']) ?></div>
                        <div class="admins-panel__pseudo">Pseudo: <?= htmlspecialchars($row['pseudo']) ?></div>
                    </div>
                    <span class="admins-panel__expand-indicator" aria-label="Afficher les actions" title="Afficher les actions"></span>
                    <div class="admins-panel__actions" style="display:none;">
                        <form method="POST" class="admins-panel__edit-form">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                            <input type="text" name="nom" class="admins-panel__input" value="<?= htmlspecialchars($row['nom']) ?>" required />
                            <input type="text" name="pseudo" class="admins-panel__input" value="<?= htmlspecialchars($row['pseudo']) ?>" required />
                            <input type="password" name="mot_de_passe" class="admins-panel__input" placeholder="Nouveau mot de passe (laisser vide pour ne pas changer)" />
                            <button type="submit" name="update" class="admins-panel__btn admins-panel__btn--edit">Modifier</button>
                        </form>
                        <a href="?delete=<?= $row['id'] ?>" class="admins-panel__btn admins-panel__btn--delete" onclick="return confirm('Supprimer cet administrateur ?')">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <script>
        function toggleActions(item) {
            var actions = item.querySelector('.admins-panel__actions');
            if (actions.style.display === 'none' || actions.style.display === '') {
                actions.style.display = 'flex';
            } else {
                actions.style.display = 'none';
            }
        }
    </script>
</body>
</html>