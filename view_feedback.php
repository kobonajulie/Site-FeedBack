<?php
require_once 'db_connect.php';

// Récupération des feedbacks
try {
    $stmt = $pdo->query("SELECT * FROM feedbacks ORDER BY feedback_date DESC");
    $feedbacks = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Erreur lors de la récupération des feedbacks: " . $e->getMessage());
}

// Calcul des statistiques
try {
    $stats = $pdo->query("
        SELECT 
            COUNT(*) as total,
            AVG(rating) as avg_rating,
            SUM(CASE WHEN rating = 5 THEN 1 ELSE 0 END) as five_stars,
            SUM(CASE WHEN rating >= 4 THEN 1 ELSE 0 END) as four_plus_stars
        FROM feedbacks
    ")->fetch();
} catch (PDOException $e) {
    $stats = ['total' => 0, 'avg_rating' => 0, 'five_stars' => 0, 'four_plus_stars' => 0];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Avis Clients</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Avis de Nos Clients</h1>
            <p>Découvrez ce que nos clients pensent de nos produits et services.</p>
        </header>

        <div class="feedback-stats">
            <div class="stat-card">
                <h3><?= $stats['total'] ?></h3>
                <p>Avis au total</p>
            </div>
            <div class="stat-card">
                <h3><?= number_format($stats['avg_rating'], 1) ?>/5</h3>
                <p>Note moyenne</p>
            </div>
            <div class="stat-card">
                <h3><?= $stats['five_stars'] ?></h3>
                <p>5 étoiles</p>
            </div>
            <div class="stat-card">
                <h3><?= $stats['four_plus_stars'] ?></h3>
                <p>4+ étoiles</p>
            </div>
        </div>

        <div class="feedback-list">
            <?php if (empty($feedbacks)): ?>
                <p class="no-feedback">Aucun feedback pour le moment. Soyez le premier à partager votre avis !</p>
            <?php else: ?>
                <?php foreach ($feedbacks as $feedback): ?>
                    <div class="feedback-item">
                        <div class="feedback-header">
                            <h3><?= htmlspecialchars($feedback['customer_name']) ?></h3>
                            <div class="feedback-rating">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <span class="star <?= $i <= $feedback['rating'] ? 'filled' : '' ?>">★</span>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <div class="feedback-meta">
                            <span><?= htmlspecialchars($feedback['product_service']) ?></span>
                            <span>•</span>
                            <span><?= date('d/m/Y H:i', strtotime($feedback['feedback_date'])) ?></span>
                        </div>
                        <?php if (!empty($feedback['comments'])): ?>
                            <div class="feedback-comments">
                                <p><?= nl2br(htmlspecialchars($feedback['comments'])) ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <div class="back-link-container">
            <a href="index.php" class="back-link">Donner votre avis</a>
        </div>
    </div>
</body>
</html>