<?php
// Inclure le fichier de connexion à la base de données
require_once 'config.php';

// Inclure le header (qui contient la barre de recherche et le début du HTML)
include 'header.php';

// 1. Récupérer l'ID de l'élément
// Assurez-vous que l'ID est bien un entier pour des raisons de sécurité
$elementId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$element = null; // Initialiser l'élément

// 2. Vérifier si un ID valide est présent
if ($elementId > 0) {
    // Requête SQL pour sélectionner l'élément par son ID
    // ATTENTION : Ajustez 'elements', 'nom', 'description', 'image_url', 'contenu_detaille'
    // en fonction des colonnes réelles de votre table de base de données.
    $sql = "SELECT *
            FROM cars 
            WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $elementId]);

        // Récupérer le premier (et unique) résultat
        $element = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        // En cas d'erreur de base de données
        echo "<div class='alert alert-danger'>Erreur de base de données : " . $e->getMessage() . "</div>";
    }
}
?>

<div class="container mt-5">
    <?php if ($element): ?>
        <h1 class="mb-4 text-center"><?php echo htmlspecialchars($element['make']) . " " . htmlspecialchars($element['model']); ?></h1>

        <div class="row ">
            <div class="col-md-5 border border-success d-flex justify-content-center align-items-center ">

                <p> Image indisponible</p>

            </div>
            <?php $available = "";
            if ($element['available'] == 1) {
                $available = "Oui";
            } else {
                $available = "Non";
            } ?>
            <div class="col-md-5 offset-1   ">
                <p class="lead text-dark fw-medium">
                    <?php echo "Model: " . htmlspecialchars($element['model']) . "<br>"; ?>
                    <?php echo "Année: " . htmlspecialchars($element['year']) . "<br>"; ?>
                    <?php echo "Couleur: " . htmlspecialchars($element['color']) . "<br>"; ?>
                    <?php echo "Kilométrage: " . htmlspecialchars($element['mileage']) . "km" . "<br>";; ?>
                    <?php echo "Disponible: " . $available; ?>
                </p>
                <hr>

                <h3>Prix € :</h3>
                <div class="card bg-light text-center ">
                    <p class=fw-bold>
                        <?php echo htmlspecialchars($element['price']); ?>
                    </p>


                </div>

                <a href="javascript:history.back()" class="btn btn-success mt-4">Retour aux résultats</a>

            </div>

        </div>

    <?php else: ?>
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">Élément non trouvé</h4>
            <p>L'identifiant **<?php echo htmlspecialchars($elementId); ?>** ne correspond à aucun élément dans la base de données.</p>
            <hr>
            <a href="index.php" class="btn btn-primary">Retour à l'accueil</a>
        </div>
    <?php endif; ?>
</div>


<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
    crossorigin="anonymous"></script>
</body>

</html>