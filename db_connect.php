<?php
$host = 'localhost';
$dbname = 'customer_feedback';
$username = 'postgres'; // Utilisateur par défaut de PostgreSQL
$password = ''; // Mot de passe que vous avez configuré

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}
?>