<?php
require_once 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation des données
    $errors = [];
    
    $customer_name = trim($_POST['customer_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $product_service = trim($_POST['product_service'] ?? '');
    $rating = intval($_POST['rating'] ?? 0);
    $comments = trim($_POST['comments'] ?? '');

    if (empty($customer_name)) {
        $errors[] = "Le nom est obligatoire.";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Un email valide est obligatoire.";
    }

    if (empty($product_service)) {
        $errors[] = "Veuillez sélectionner un produit/service.";
    }

    if ($rating < 1 || $rating > 5) {
        $errors[] = "Veuillez donner une note entre 1 et 5 étoiles.";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO feedbacks (customer_name, email, product_service, rating, comments) 
                                 VALUES (:customer_name, :email, :product_service, :rating, :comments)");
            
            $stmt->execute([
                ':customer_name' => $customer_name,
                ':email' => $email,
                ':product_service' => $product_service,
                ':rating' => $rating,
                ':comments' => $comments
            ]);
            
            $success = "Merci pour votre feedback ! Nous apprécions votre temps et vos commentaires.";
        } catch (PDOException $e) {
            $errors[] = "Une erreur est survenue lors de l'enregistrement de votre feedback. Veuillez réessayer.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Envoyé</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <h2>Erreur</h2>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="index.php" class="back-link">Retour au formulaire</a>
            </div>
        <?php elseif (isset($success)): ?>
            <div class="success-message">
                <h2>Merci !</h2>
                <p><?= htmlspecialchars($success) ?></p>
                <div class="actions">
                    <a href="index.php" class="action-link">Donner un autre feedback</a>
                    <a href="view_feedback.php" class="action-link">Voir les feedbacks</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>