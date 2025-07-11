<?php
    $verset_du_jour = null;
    $livre_du_jour = null;
    $activite_du_jour = null;
    $activite_image = null;
    $activites_semaine = [];
    try {
        require_once "database/credentials.php";
        $pdo = new PDO("mysql:dbname=$dbname;host=$server;charset=UTF8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $today = date('Y-m-d');
        // Verset du jour
        $stmt = $pdo->prepare("SELECT verset, livre FROM versets WHERE date_publication = ? LIMIT 1");
        $stmt->execute([$today]);
        $row = $stmt->fetch();
        if ($row) {
            $verset_du_jour = $row['verset'];
            $livre_du_jour = $row['livre'];
        }
        // Activité du jour
        $stmt = $pdo->prepare("SELECT id, titre, contenu FROM activites WHERE date_activite = ? LIMIT 1");
        $stmt->execute([$today]);
        $activite = $stmt->fetch();
        if ($activite) {
            $activite_du_jour = $activite;
            $stmtImg = $pdo->prepare("SELECT lien FROM images WHERE activites_id = ? LIMIT 1");
            $stmtImg->execute([$activite['id']]);
            $img = $stmtImg->fetch();
            if ($img) {
                $activite_image = $img['lien'];
            }
        }

        // Calculer le début et la fin de la semaine (lundi à dimanche)
        $currentDate = new DateTime($today);
        $startOfWeek = clone $currentDate;
        $startOfWeek->modify('monday this week');
        $endOfWeek = clone $startOfWeek;
        $endOfWeek->modify('sunday this week');
        $startStr = $startOfWeek->format('Y-m-d');
        $endStr = $endOfWeek->format('Y-m-d');

        // Récupérer toutes les activités de la semaine
        $stmt = $pdo->prepare("SELECT a.id, a.titre, a.date_activite, a.contenu, i.lien AS image FROM activites a LEFT JOIN images i ON a.id = i.activites_id AND i.id = (SELECT MIN(id) FROM images WHERE activites_id = a.id) WHERE a.date_activite BETWEEN ? AND ? ORDER BY a.date_activite ASC");
        $stmt->execute([$startStr, $endStr]);
        $activites_semaine = $stmt->fetchAll();
    } catch (Exception $e) {
        echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <?php include_once "parts/user/head.php" ?>
    <title>Acceuil • Eglise méthodiste du Togo - Tokoin Wuiti</title>
</head>

<body>
    <header class="header">
        <?php include_once "parts/user/header.php" ?>
    </header>
    <main class="main">
        <div class="verse__container">
            <h1 class="verse__heading">Verset du jour</h1>
            <div class="verse__content">
                <?php if ($verset_du_jour): ?>
                    <p class="verse__text"><?= htmlspecialchars($verset_du_jour) ?></p>
                    <p class="verse__book"><?= htmlspecialchars($livre_du_jour) ?></p>
                <?php else: ?>
                    <p class="verse__text">Pas de verset pour aujourd'hui</p>
                <?php endif; ?>
            </div>
        </div>
        <div class="today__container">
            <h1 class="today__heading">Aujourd'hui</h1>
            <?php if ($activite_du_jour): ?>
                <div class="today__banner">
                    <?php if ($activite_image): ?>
                        <img src="<?= htmlspecialchars($activite_image) ?>" alt="Image activité" class="today__image" />
                    <?php endif; ?>
                    <div class="today__details">
                        <h2 class="today__title"><?= htmlspecialchars($activite_du_jour['titre']) ?></h2>
                        <p class="today__content"><?= nl2br(htmlspecialchars($activite_du_jour['contenu'])) ?></p>
                    </div>
                </div>
            <?php else: ?>
                <p class="today__text">Aucune activité n'est prévue pour aujourd'hui</p>
            <?php endif; ?>
        </div>
        <div class="week_container">
            <h1 class="week__heading">Cette semaine</h1>
            <div class="week__list">
                <?php if (!empty($activites_semaine)): ?>
                    <?php foreach ($activites_semaine as $activite): ?>
                        <div class="week__item">
                            <div class="week__item-header">
                                <span class="week__item-date">
                                    <?= htmlspecialchars(date('d/m/Y', strtotime($activite['date_activite']))) ?>
                                </span>
                                <span class="week__item-title">
                                    <?= htmlspecialchars($activite['titre']) ?>
                                </span>
                            </div>
                            <?php if (!empty($activite['image'])): ?>
                                <img src="<?= htmlspecialchars($activite['image']) ?>" alt="Image activité" class="week__item-image" />
                            <?php endif; ?>
                            <div class="week__item-content">
                                <?= nl2br(htmlspecialchars($activite['contenu'])) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="week__text">Aucune activité prévue cette semaine.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <footer class="footer">
        <?php include_once "parts/user/footer.php" ?>
    </footer>
</body>

</html>