<?php
session_start();
require_once 'config.php';

// Création automatique de la table admin si elle n'existe pas
$conn->query("CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL
)");

// Insertion d'un admin par défaut (à supprimer après première connexion)
$conn->query("INSERT IGNORE INTO admins (username, password_hash) VALUES (
    'admin',
    '$2y$10\$v5M04yaixFxO85rAlWY1R.q.53Hw4HpBZ...'
)");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $stmt = $conn->prepare("SELECT password_hash FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    
    if ($stmt->num_rows > 0 && password_verify($password, $stmt->get_result()->fetch_row()[0])) {
        $_SESSION['admin_logged_in'] = true;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Identifiants incorrects";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Admin</title>
    <link href="../css/conn.css">
</head>
<body>
    <div class="login-container">
        <h1 style="text-align:center;color:#a32d2d">Connexion Admin</h1>
        <?php if (isset($error)): ?>
            <p style="color:red;text-align:center"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Se connecter</button>
        </form>
    </div>
</body>
</html>