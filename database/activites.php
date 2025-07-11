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
        $stmt = $pdo->prepare("INSERT INTO activites (titre, date_activite, contenu) VALUES (?, ?, ?)");
        $stmt->execute([
            $_POST['titre'],
            $_POST['date_activite'],
            $_POST['contenu']
        ]);
        $activite_id = $pdo->lastInsertId();
        // Handle image upload
        if (!empty($_FILES['images']['name'])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['images']['name'][$key];
                $target_path = dirname(__DIR__) . '\\static\\uploads\\' . $file_name;
                if (move_uploaded_file($tmp_name, $target_path)) {
                    $stmtImg = $pdo->prepare("INSERT INTO images (lien, activites_id) VALUES (?, ?)");
                    $stmtImg->execute([$target_path, $activite_id]);
                }
            }
        }
    }
    // Delete
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $stmt = $pdo->prepare("DELETE FROM activites WHERE id = ?");
        $stmt->execute([$id]);
    }
    // Update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $id = intval($_POST['id']);
        $stmt = $pdo->prepare("UPDATE activites SET titre = ?, date_activite = ?, contenu = ? WHERE id = ?");
        $stmt->execute([
            $_POST['titre'],
            $_POST['date_activite'],
            $_POST['contenu'],
            $id
        ]);
        // Handle image upload for update
        if (!empty($_FILES['images']['name'][0])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $file_name = basename($_FILES['images']['name'][$key]);
                $target_path = getcwd() . '/static/uploads/' . $file_name;
                if (move_uploaded_file($tmp_name, $target_path)) {
                    $stmtImg = $pdo->prepare("INSERT INTO images (lien, activites_id) VALUES (?, ?)");
                    $stmtImg->execute([$target_path, $id]);
                }
            }
        }
    }
    // Fetch all
    $stmt = $pdo->query("SELECT * FROM activites ORDER BY date_activite DESC, id DESC");
    $activites = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once "../parts/admin/head.php" ?>
    <title>Activités - Eglise méthodiste du Togo</title>
</head>
<body>
    <header class="header">
        <?php include_once "../parts/admin/header.php" ?>
    </header>
    <main class="activites-panel">
        <h1 class="activites-panel__title">Gestion des activités</h1>
        <form class="activites-panel__form" method="POST" enctype="multipart/form-data">
            <input type="text" name="titre" class="activites-panel__input" placeholder="Titre" required />
            <input type="date" name="date_activite" class="activites-panel__input" required />
            <textarea name="contenu" class="activites-panel__input" placeholder="Contenu" required></textarea>
            <input type="file" name="images[]" class="activites-panel__input" multiple accept="image/*" />
            <button type="submit" name="add" class="activites-panel__btn">Ajouter</button>
        </form>
        <section class="activites-panel__list">
            <?php foreach($activites as $row): ?>
                <?php $stmtImg = $pdo->prepare("SELECT lien FROM images WHERE activites_id = ?"); $stmtImg->execute([$row['id']]); $images = $stmtImg->fetchAll(); ?>
                <div class="activites-panel__item" onclick="toggleActions(this)">
                    <div class="activites-panel__info">
                        <div class="activites-panel__titre"><?= htmlspecialchars($row['titre']) ?></div>
                        <div class="activites-panel__date">Date: <?= htmlspecialchars($row['date_activite']) ?></div>
                        <div class="activites-panel__contenu"><?= nl2br(htmlspecialchars($row['contenu'])) ?></div>
                        <div class="activites-panel__images">
                            <?php foreach($images as $img): ?>
                                <img src="<?= $img['lien'] ?>" class="activites-panel__image" alt="Image activité" />
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <span class="activites-panel__expand-indicator" aria-label="Afficher les actions" title="Afficher les actions"></span>
                    <div class="activites-panel__actions" style="display:none;">
                        <form method="POST" class="activites-panel__edit-form" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                            <input type="text" name="titre" class="activites-panel__input" value="<?= htmlspecialchars($row['titre']) ?>" required />
                            <input type="date" name="date_activite" class="activites-panel__input" value="<?= htmlspecialchars($row['date_activite']) ?>" required />
                            <textarea name="contenu" class="activites-panel__input" required><?= htmlspecialchars($row['contenu']) ?></textarea>
                            <input type="file" name="images[]" class="activites-panel__input" multiple accept="image/*" />
                            <button type="submit" name="update" class="activites-panel__btn activites-panel__btn--edit">Modifier</button>
                        </form>
                        <a href="?delete=<?= $row['id'] ?>" class="activites-panel__btn activites-panel__btn--delete" onclick="return confirm('Supprimer cette activité ?')">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <script>
        function toggleActions(item) {
            var actions = item.querySelector('.activites-panel__actions');
            if (actions.style.display === 'none' || actions.style.display === '') {
                actions.style.display = 'flex';
            } else {
                actions.style.display = 'none';
            }
        }
    </script>
</body>
</html>