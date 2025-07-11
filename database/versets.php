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
        $stmt = $pdo->prepare("INSERT INTO versets (verset, livre, date_publication) VALUES (?, ?, ?)");
        $stmt->execute([
            $_POST['verset'],
            $_POST['livre'],
            $_POST['date_publication']
        ]);
    }
    // Delete
    if (isset($_GET['delete'])) {
        $id = intval($_GET['delete']);
        $stmt = $pdo->prepare("DELETE FROM versets WHERE id = ?");
        $stmt->execute([$id]);
    }
    // Update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
        $id = intval($_POST['id']);
        $stmt = $pdo->prepare("UPDATE versets SET verset = ?, livre = ?, date_publication = ? WHERE id = ?");
        $stmt->execute([
            $_POST['verset'],
            $_POST['livre'],
            $_POST['date_publication'],
            $id
        ]);
    }
    // Sorting mechanism
    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'date_publication_desc';
    $orderBy = "date_publication DESC, id DESC";
    if ($sort === 'date_publication_asc') $orderBy = "date_publication ASC, id ASC";
    if ($sort === 'livre_asc') $orderBy = "livre ASC, id ASC";
    if ($sort === 'livre_desc') $orderBy = "livre DESC, id DESC";
    // Fetch all
    $stmt = $pdo->query("SELECT * FROM versets ORDER BY $orderBy");
    $versets = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <?php include_once "../parts/admin/head.php" ?>
    <title>Versets - Eglise méthodiste du Togo</title>
</head>
<body>
    <header class="header">
        <?php include_once "../parts/admin/header.php" ?>
    </header>
    <main class="versets-panel">
        <h1 class="versets-panel__title">Gestion des versets</h1>
        <form class="versets-panel__form" method="POST">
            <textarea name="verset" class="versets-panel__input" placeholder="Verset" required></textarea>
            <input type="text" name="livre" class="versets-panel__input" placeholder="Livre" required />
            <input type="date" name="date_publication" class="versets-panel__input" required />
            <button type="submit" name="add" class="versets-panel__btn">Ajouter</button>
        </form>
        <div class="versets-panel__sort">
            <form method="GET" class="versets-panel__sort-form">
                <label for="sort" class="versets-panel__sort-label">Trier par :</label>
                <select name="sort" id="sort" class="versets-panel__sort-select" onchange="this.form.submit()">
                    <option value="date_publication_desc"<?= $sort==='date_publication_desc'?' selected':'' ?>>Date (plus récent)</option>
                    <option value="date_publication_asc"<?= $sort==='date_publication_asc'?' selected':'' ?>>Date (plus ancien)</option>
                    <option value="livre_asc"<?= $sort==='livre_asc'?' selected':'' ?>>Livre (A-Z)</option>
                    <option value="livre_desc"<?= $sort==='livre_desc'?' selected':'' ?>>Livre (Z-A)</option>
                </select>
            </form>
        </div>
        <section class="versets-panel__list">
            <?php foreach($versets as $row): ?>
                <div class="versets-panel__item" onclick="toggleActions(this)">
                    <div class="versets-panel__info">
                        <div class="versets-panel__verset"><?= htmlspecialchars($row['verset']) ?></div>
                        <div class="versets-panel__livre">Livre: <?= htmlspecialchars($row['livre']) ?></div>
                        <div class="versets-panel__date">Publication: <?= htmlspecialchars($row['date_publication']) ?></div>
                    </div>
                    <span class="versets-panel__expand-indicator" aria-label="Afficher les actions" title="Afficher les actions"></span>
                    <div class="versets-panel__actions" style="display:none;">
                        <form method="POST" class="versets-panel__edit-form">
                            <input type="hidden" name="id" value="<?= $row['id'] ?>" />
                            <textarea name="verset" class="versets-panel__input" required><?= htmlspecialchars($row['verset']) ?></textarea>
                            <input type="text" name="livre" class="versets-panel__input" value="<?= htmlspecialchars($row['livre']) ?>" required />
                            <input type="date" name="date_publication" class="versets-panel__input" value="<?= htmlspecialchars($row['date_publication']) ?>" required />
                            <button type="submit" name="update" class="versets-panel__btn versets-panel__btn--edit">Modifier</button>
                        </form>
                        <a href="?delete=<?= $row['id'] ?>" class="versets-panel__btn versets-panel__btn--delete" onclick="return confirm('Supprimer ce verset ?')">Supprimer</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <script>
        function toggleActions(item) {
            var actions = item.querySelector('.versets-panel__actions');
            if (actions.style.display === 'none' || actions.style.display === '') {
                actions.style.display = 'flex';
            } else {
                actions.style.display = 'none';
            }
        }
    </script>
</body>
</html>