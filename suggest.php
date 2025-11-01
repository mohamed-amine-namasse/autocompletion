<?php
header('Content-Type: application/json'); // Indique que la réponse est du JSON

// Inclure la connexion à la base de données
require_once 'config.php';

$query = isset($_GET['q']) ? trim($_GET['q']) : '';
$suggestions = [];

if (strlen($query) >= 1) { // Ne pas rechercher si le terme est trop court

    // Assurez-vous d'ajuster 'elements' et 'nom' à votre structure de table

    // --- Partie 1 : Correspondance exacte (commence par) ---
    $sql_starts_with = "SELECT make FROM cars WHERE make LIKE :query_start LIMIT 5";
    $query_start = $query . '%';

    try {
        $stmt_start = $pdo->prepare($sql_starts_with);
        $stmt_start->execute(['query_start' => $query_start]);
        $suggestions['starts_with'] = $stmt_start->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        // Gérer l'erreur si nécessaire
        $suggestions['starts_with'] = [];
    }

    // --- Partie 2 : Correspondance partielle (contient) ---
    // Exclure ceux déjà trouvés pour éviter les doublons dans la 2ème section
    $sql_contains = "SELECT make FROM cars WHERE make LIKE :query_contains AND make NOT LIKE :query_start LIMIT 5";
    $query_contains = '%' . $query . '%';

    try {
        $stmt_contains = $pdo->prepare($sql_contains);
        $stmt_contains->execute([
            'query_contains' => $query_contains,
            'query_start' => $query_start
        ]);
        $suggestions['contains'] = $stmt_contains->fetchAll(PDO::FETCH_COLUMN);
    } catch (PDOException $e) {
        // Gérer l'erreur si nécessaire
        $suggestions['contains'] = [];
    }
}

// Renvoyer les résultats au format JSON
echo json_encode($suggestions);
