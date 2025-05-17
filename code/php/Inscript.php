<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $category = $_POST['category'];
    
    // Traitement du fichier uploadé
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Vérification si le fichier est une image
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "Le fichier n'est pas une image.";
        $uploadOk = 0;
    }
    
    // Vérification de la taille du fichier
    if ($_FILES["photo"]["size"] > 500000) {
        echo "Désolé, votre fichier est trop volumineux.";
        $uploadOk = 0;
    }
    
    // Autoriser certains formats de fichier
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Désolé, seuls les fichiers JPG, JPEG, PNG & GIF sont autorisés.";
        $uploadOk = 0;
    }
    
    // Vérifier si $uploadOk est à 0 à cause d'une erreur
    if ($uploadOk == 0) {
        echo "Désolé, votre fichier n'a pas été uploadé.";
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            // Enregistrement des données en base de données (à adapter)
            // $db = new PDO('mysql:host=localhost;dbname=ium_awards', 'username', 'password');
            // $stmt = $db->prepare("INSERT INTO nominations (name, email, category, photo) VALUES (?, ?, ?, ?)");
            // $stmt->execute([$name, $email, $category, $target_file]);
            
            // Redirection après succès
            header("Location: index.php?success=1");
            exit();
        } else {
            echo "Désolé, une erreur s'est produite lors de l'upload de votre fichier.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation - Awards IUM</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="animated-header">
        <h1>ANNUAL AWARDS <br> <strong>IUM SHINE</strong>🏆</h1>
    </header>

    <nav class="animated-nav">
        <button class="nav-toggle" aria-expanded="false" aria-label="Menu">☰</button>
        <div class="nav-links" data-visible="false">
            <a href="index.php">Accueil</a>
            <a href="#">Catégories</a>
            <a href="nominer.php">Nominer</a>
            <a href="#">Voter</a>
            <a href="#">Résultats</a>
            <a href="inscri_ad.php">Admin</a>
        </div>
    </nav>

    <main class="confirmation">
        <h2>Merci pour votre inscription !</h2>
        <p>Votre candidature a bien été enregistrée. Vous recevrez un email de confirmation sous peu.</p>
        <a href="index.php" class="btn">Retour à l'accueil</a>
    </main>

    <footer>
        <p>&copy; 2025 Awards IUM. Tous droits réservés.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>