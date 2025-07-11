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
        $stmt = $pdo->prepare("INSERT INTO enseignements (titre, date_enseignement, description, lien, predicateur) VALUES (?, ?, ?, ?, ?)");
        $file_path = '';
        if (!empty($_FILES['lien']['name'])) {
            $file_name = basename($_FILES['lien']['name']);
            $file_path = dirname(__DIR__) . '/static/uploads/' . $file_name;
            if (move_uploaded_file($_FILES['lien']['tmp_name'], $file_path)) {
                $file_path = 'static/uploads/' . $file_name;
            } else {
                $file_path = '';
            }
        }
        $stmt->execute([
            $_POST['titre'],
            $_POST['date_enseignement'],
            $_POST['description'],
            $file_path,
            $_POST['predicateur']
        ]);
    }
    // Delete
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $stmt = $pdo->prepare("DELETE FROM enseignements WHERE id = ?");
        $stmt->execute([$id]);
    }
    // Update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $id = intval($_POST['id']);
        $file_path = $_POST['old_lien'];
        if (!empty($_FILES['lien']['name'])) {
            $file_name = basename($_FILES['lien']['name']);
            $new_path = dirname(__DIR__) . '/static/uploads/' . $file_name;
            if (move_uploaded_file($_FILES['lien']['tmp_name'], $new_path)) {
                $file_path = 'static/uploads/' . $file_name;
            }
        }
        $stmt = $pdo->prepare("UPDATE enseignements SET titre = ?, date_enseignement = ?, description = ?, lien = ?, predicateur = ? WHERE id = ?");
        $stmt->execute([
            $_POST['titre'],
            $_POST['date_enseignement'],
            $_POST['description'],
            $file_path,
            $_POST['predicateur'],
            $id
        ]);
    }
    // Fetch all
    $stmt = $pdo->query("SELECT * FROM enseignements ORDER BY date_enseignement DESC, id DESC");
    $enseignements = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once "../parts/admin/head.php" ?>
    <title>Enseignements - Eglise méthodiste du Togo</title>
</head>
<body>
    <header class="header">
        <?php include_once "../parts/admin/header.php" ?>
    </header>
    <main class="enseignements-panel">
        <h1 class="enseignements-panel__title">Gestion des enseignements</h1>
        <form class="enseignements-panel__form" method="POST" enctype="multipart/form-data">
            <input type="text" name="titre" class="enseignements-panel__input" placeholder="Titre" required />
            <input type="date" name="date_enseignement" class="enseignements-panel__input" required />
            <textarea name="description" class="enseignements-panel__input" placeholder="Description" required></textarea>
            <input type="file" name="lien" class="enseignements-panel__input" accept="audio/*,video/*" />
            <input type="text" name="predicateur" class="enseignements-panel__input" placeholder="Prédicateur" required />
            <button type="submit" name="add" class="enseignements-panel__btn">Ajouter</button>
        </form>
        <section class="enseignements-panel__list">
            <?php foreach($enseignements as $row): ?>
                <div class="enseignements-panel__item" onclick="toggleActions(this)">
                    <div class="enseignements-panel__info">
                        <div class="enseignements-panel__titre"><?= htmlspecialchars($row['titre']) ?></div>
                        <div class="enseignements-panel__date">Date: <?= htmlspecialchars($row['date_enseignement']) ?></div>
                        <div class="enseignements-panel__description"><?= nl2br(htmlspecialchars($row['description'])) ?></div>
                        <div class="enseignements-panel__lien">
                            <?php if ($row['lien']): ?>
                                <?php $ext = strtolower(pathinfo($row['lien'], PATHINFO_EXTENSION)); ?>
                                <?php if (in_array($ext, ['mp3','wav','ogg'])): ?>
                                    <audio controls src="../<?= $row['lien'] ?>"></audio>
                                <?php elseif (in_array($ext, ['mp4','webm','ogg'])): ?>
                                    <video controls width="320" src="../<?= $row['lien'] ?>"></video>
                                <?php else: ?>
                                    <a href="../<?= $row['lien'] ?>" target="_blank">Fichier</a>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="enseignements-panel__predicateur">Prédicateur: <?= htmlspecialchars($row['predicateur']) ?></div>
                    </div>
                    <span class="enseignements-panel__expand-indicator" aria-label="Afficher les actions" title="Afficher les actions"></span>
                    <div class="enseignements-panel__actions" style="display:none;">
                        <form method="POST" class="enseignements-panel__edit-form" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                            <input type="hidden" name="old_lien" value="<?= htmlspecialchars($row['lien']) ?>" />
                            <input type="text" name="titre" class="enseignements-panel__input" value="<?= htmlspecialchars($row['titre']) ?>" required />
                            <input type="date" name="date_enseignement" class="enseignements-panel__input" value="<?= htmlspecialchars($row['date_enseignement']) ?>" required />
                            <textarea name="description" class="enseignements-panel__input" required><?= htmlspecialchars($row['description']) ?></textarea>
                            <input type="file" name="lien" class="enseignements-panel__input" accept="audio/*,video/*" />
                            <input type="text" name="predicateur" class="enseignements-panel__input" value="<?= htmlspecialchars($row['predicateur']) ?>" required />
                            <button type="submit" name="update" class="enseignements-panel__btn enseignements-panel__btn--edit">Modifier</button>
                        </form>
                        <a href="?delete=<?= $row['id'] ?>" class="enseignements-panel__btn enseignements-panel__btn--delete" onclick="return confirm('Supprimer cet enseignement ?')">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <script>
        function toggleActions(item) {
            var actions = item.querySelector('.enseignements-panel__actions');
            if (actions.style.display === 'none' || actions.style.display === '') {
                actions.style.display = 'flex';
            } else {
                actions.style.display = 'none';
            }
        }
    </script>
</body>
</html>