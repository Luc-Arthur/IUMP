<?php
// Connexion à la base
$conn = new mysqli("fdb1030.awardspace.net", "4630587_awards", "Christ2005@", "4630587_awards");

// Requête pour récupérer tous les candidats avec leurs catégories
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - Administration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }
        h2 {
            color: #973f39;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #973f39;
            color: white;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        img {
            width: 60px;
            height: auto;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <h2>Liste des Candidats Inscrits</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Numéro</th>
                <th>Photo</th>
                <th>Catégories</th>
            </tr>
        </thead>
        <?php
$sql = "SELECT nom, email, numero_attribution, photo, categorie AS categories FROM candidats"; // ajuste si besoin
$result = $conn->query($sql);

if ($result && $result->num_rows > 0): ?>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['nom']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['numero_attribution']) ?></td>
            <td><img src="uploads/<?= htmlspecialchars($row['photo']) ?>" alt="Photo" style="max-height: 80px;"></td>
            <td><?= htmlspecialchars($row['categories']) ?></td>
        </tr>
    <?php endwhile; ?>
<?php else: ?>
    <tr><td colspan="5">Aucun candidat trouvé ou erreur dans la requête.</td></tr>
<?php endif; ?>

    </table>
</body>
</html>

<?php $conn->close(); ?>
