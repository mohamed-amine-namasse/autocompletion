<?php
$servername = "localhost";
$username   = "root";
$password   = "";
$DBname     = "autocompletion";

try {
    $pdo = new PDO(
        "mysql:host=$servername;dbname=$DBname",
        $username,
        $password
    );
    // définir le mode d'erreur PDO sur exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "La connexion a échoué: " . $e->getMessage();
}
