<?php
// Inclure le fichier de connexion à la base de données
// Assurez-vous que ce fichier contient les informations de connexion ($pdo)
require_once 'config.php';

// Inclure le header (qui contient la barre de recherche)
include 'header.php';

// Récupérer le terme de recherche depuis l'URL (GET)
$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$results = []; // Initialiser le tableau de résultats

if (!empty($searchTerm)) {
    // 1. Terme de recherche : Assurez la sécurité avec des requêtes préparées
    // La recherche se fera sur une colonne 'nom' ou 'titre'
    $searchPattern = '%' . $searchTerm . '%';

    // Exemple de requête SQL pour rechercher dans le nom et la description (ajustez les colonnes)
    $sql = "SELECT id,make ,color
            FROM cars 
            WHERE make LIKE :search  
            ORDER BY make ASC";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['search' => $searchPattern]);

        // Récupérer tous les résultats
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // En cas d'erreur de base de données
        echo "<div class='alert alert-danger'>Erreur de base de données : " . $e->getMessage() . "</div>";
    }
}
?>


<div class="container mt-5">
    <h2>Résultats de la recherche pour : "<?php echo htmlspecialchars($searchTerm); ?>"</h2>

    <?php if (empty($searchTerm)): ?>
        <p class="alert alert-warning">Veuillez entrer un terme de recherche.</p>
    <?php elseif (empty($results)): ?>
        <p class="alert alert-info">Aucun résultat trouvé pour "<?php echo htmlspecialchars($searchTerm); ?>".</p>
    <?php else: ?>
        <p>Nous avons trouvé **<?php echo count($results); ?>** résultat(s) :</p>

        <ul class="list-group">
            <?php foreach ($results as $element): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h4>
                            <a href="element.php?id=<?php echo htmlspecialchars($element['id']); ?>">
                                <?php echo htmlspecialchars($element['make']); ?>
                            </a>
                        </h4>

                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>


</body>

</html>