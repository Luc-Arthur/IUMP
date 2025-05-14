<?php
$host = 'fdb1030.awardspace.net';
$user = '4630587_awards';
$pass = 'Christ2005@';
$dbname = '4630587_awards';

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$nom = $_POST['name'];
$email = $_POST['email'];
$categorie = $_POST['category'];
$photoName = $_FILES['photo']['name'];
$photoTmp = $_FILES['photo']['tmp_name'];

// Gérer l'upload
$uploadDir = 'PHOTOS/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}
$uploadPath = $uploadDir . basename($photoName);
move_uploaded_file($photoTmp, $uploadPath);

// Vérifier si le candidat existe
$stmt = $conn->prepare("SELECT idNomi, numero_attribution FROM candidats WHERE nom = ?");
$stmt->bind_param("s", $nom);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($candidatId, $numeroAttribution);
$stmt->fetch();

if ($stmt->num_rows > 0) {
    // Déjà inscrit → garder le même numéro
    $newcategorie = $_POST['category'];
    $stmt->close();
} else {
    // Générer un nouveau numéro d'attribution
    if ($categorie === "trinome" || $categorie === "binome") {
        $prefix = $categorie === "trinome" ? "G" : "G";
        $query = $conn->query("SELECT COUNT(*) AS total FROM candidats WHERE numero_attribution LIKE '$prefix%'");
        $row = $query->fetch_assoc();
        $numeroAttribution = $prefix . ($row['total'] + 1);
    }
    else {
        $query = $conn->query("SELECT COUNT(*) AS total FROM candidats WHERE numero_attribution REGEXP '^[0-9]+$'");
        $row = $query->fetch_assoc();
        $numeroAttribution = str_pad($row['total'] + 1, 2, "0", STR_PAD_LEFT);
    }

    // Insérer le candidat
    $stmt = $conn->prepare("INSERT INTO candidats (nom, email, categorie, photo, numero_attribution) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nom, $email, $categorie, $photoName, $numeroAttribution);
    $stmt->execute();
    $candidatId = $stmt->insert_id;
    $stmt->close();
}

// Notification
echo "<script>
    alert('Inscription réussie et votre numéro d’attribution est : $numeroAttribution');
    window.location.href = 'index.html';
</script>";

$conn->close();
?>

