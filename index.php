<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Client - Partagez votre avis</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <h1>Votre Avis Nous Importe</h1>
            <p>Aidez-nous à améliorer nos produits et services en partageant votre expérience.</p>
        </header>

        <div class="feedback-form">
            <form action="process_feedback.php" method="POST">
                <div class="form-group">
                    <label for="customer_name">Votre Nom *</label>
                    <input type="text" id="customer_name" name="customer_name" required>
                </div>

                <div class="form-group">
                    <label for="email">Votre Email *</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="product_service">Produit/Service concerné *</label>
                    <select id="product_service" name="product_service" required>
                        <option value="">-- Sélectionnez --</option>
                        <option value="Produit A">Produit A</option>
                        <option value="Produit B">Produit B</option>
                        <option value="Service Client">Service Client</option>
                        <option value="Site Web">Site Web</option>
                        <option value="Autre">Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Note (1 à 5 étoiles) *</label>
                    <div class="rating">
                        <input type="radio" id="star5" name="rating" value="5" required>
                        <label for="star5">★</label>
                        <input type="radio" id="star4" name="rating" value="4">
                        <label for="star4">★</label>
                        <input type="radio" id="star3" name="rating" value="3">
                        <label for="star3">★</label>
                        <input type="radio" id="star2" name="rating" value="2">
                        <label for="star2">★</label>
                        <input type="radio" id="star1" name="rating" value="1">
                        <label for="star1">★</label>
                    </div>
                </div>

                <div class="form-group">
                    <label for="comments">Vos commentaires</label>
                    <textarea id="comments" name="comments" rows="5"></textarea>
                </div>

                <button type="submit" class="submit-btn">Envoyer le Feedback</button>
            </form>
        </div>

        <div class="view-feedback-link">
            <a href="view_feedback.php">Voir les feedbacks des autres clients</a>
        </div>
    </div>
</body>
</html>