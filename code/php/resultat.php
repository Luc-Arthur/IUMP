<?php
include('header.php');
require_once 'config.php';
?>

<section class="results-page">
    <h1>Résultats du Vote</h1>
    <p>Découvrez les candidats les plus populaires dans chaque catégorie</p>

    <?php
    $categories = [
        'etudiants' => 'Meilleurs Étudiants',
        'leader' => 'Leader Inspirant',
        'binome' => 'Meilleur Binôme/Trinôme',
        'joueurs' => 'Meilleurs Joueurs',
        'roi_reine' => 'Roi/Reine',
        'style' => 'Meilleur Style',
        'bue' => 'Meilleurs BUE'
    ];

    foreach ($categories as $key => $label):
        $query = "SELECT c.id, c.nom, c.photo, COUNT(v.id) as votes 
                 FROM candidats c
                 LEFT JOIN votes v ON c.id = v.candidat_id
                 WHERE c.categorie = ? AND c.status = 'Validée'
                 GROUP BY c.id
                 ORDER BY votes DESC
                 LIMIT 5"; // Top 5 par catégorie
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $key);
        $stmt->execute();
        $candidats = $stmt->get_result();
    ?>
    
    <div class="category-results">
        <h2><?= $label ?></h2>
        
        <div class="candidates-list">
            <?php while($candidat = $candidats->fetch_assoc()): ?>
            <div class="candidate-result">
                <img src="uploads/<?= htmlspecialchars($candidat['photo']) ?>" alt="<?= htmlspecialchars($candidat['nom']) ?>">
                <div class="candidate-info">
                    <h3><?= htmlspecialchars($candidat['nom']) ?></h3>
                    <div class="vote-count">
                        <span class="votes-number"><?= $candidat['votes'] ?></span>
                        <span>votes</span>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php endforeach; ?>
</section>

<?php include('footer.php'); ?>