<?php
// config.php (nouvelle version minimale)
$servername = "localhost";
$username = "root"; // À remplacer
$password = ""; // À remplacer
$dbname = "ajout_can"; // Votre nouvelle base

// Connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification
if ($conn->connect_error) {
    die("Échec de connexion : " . $conn->connect_error);
}

// Sécurité : empêcher l'accès direct
if (basename($_SERVER['PHP_SELF']) === 'config.php') {
    header('HTTP/1.0 403 Forbidden');
    exit('Accès interdit');
}
?>