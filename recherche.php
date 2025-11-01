<?php
// Inclure le fichier de connexion à la base de données
// Assurez-vous que ce fichier contient les informations de connexion ($pdo)
require_once 'config.php';

// Inclure le header (qui contient la barre de recherche)
include 'header.php';




$searchTerm = isset($_GET['search']) ? trim($_GET['search']) : '';
$results = [];

if (!empty($searchTerm)) {
    // Séparer le terme de recherche en mots individuels (par espace)
    $searchWords = explode(' ', $searchTerm);
    // Filtrer les mots vides ou très courts
    $searchWords = array_filter($searchWords, function ($word) {
        return strlen($word) > 1; // Optionnel : Ignorer les lettres uniques dans la recherche complète
    });

    if (!empty($searchWords)) {

        // Construction dynamique de la clause WHERE
        $whereClauses = [];
        $bindings = [];
        $i = 0;

        foreach ($searchWords as $word) {
            $wordPattern = '%' . $word . '%';
            $paramName = ':search' . $i++;

            // Pour chaque mot, on vérifie s'il est contenu dans 'nom' OU 'couleur'
            $whereClauses[] = "(make LIKE $paramName OR color LIKE $paramName)";
            $bindings[$paramName] = $wordPattern;
        }

        // Utiliser 'OR' pour trouver les éléments qui contiennent au moins UN des mots
        $whereString = implode(' OR ', $whereClauses);

        // Reconstruire la requête SQL
        $sql = "SELECT id, make, color 
                FROM cars 
                WHERE $whereString
                ORDER BY make ASC";

        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($bindings); // Utiliser le tableau de liaisons

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Erreur de base de données : " . $e->getMessage() . "</div>";
        }
    }
}
// ... (suite du script et affichage des résultats)
?>

<div class="container mt-5">
    <h2>Résultats de la recherche pour : "<?php echo htmlspecialchars($searchTerm); ?>"</h2>

    <?php if (empty($searchTerm)): ?>
        <p class="alert alert-warning">Veuillez entrer un terme de recherche.</p>
    <?php elseif (empty($results)): ?>
        <p class="alert alert-danger">Aucun résultat trouvé pour "<?php echo htmlspecialchars($searchTerm); ?>".</p>
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