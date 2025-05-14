<?php
session_start();

$conn = new mysqli('fdb1030.awardspace.net', '4630587_awards', 'Christ2005@', '4630587_awards');
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT id, mot_de_passe FROM admin WHERE nom = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $hashedPassword);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
        $_SESSION['id'] = $id;
        header("Location: dash.php");
        exit();
    } else {
        echo "Mot de passe incorrect.";
    }
} else {
    echo "Nom d'utilisateur invalide.";
}

$stmt->close();
$conn->close();
?>
