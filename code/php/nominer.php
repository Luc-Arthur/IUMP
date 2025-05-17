<?php
include('header.php');
require_once 'config.php';
?>

<section class="presentation-candidats">
    <h1>PRÉSENTATION DES CANDIDATS</h1>
    
    <div class="categories-menu">
        <div class="category-toggle">
            <span>Leader Inspirant</span>
            <i class="arrow down"></i>
        </div>
        <!-- Répétez pour chaque catégorie -->
    </div>
    
    <div class="candidates-container">
        <?php
        $categories = ['leader', 'etudiants', 'binome'];
        foreach ($categories as $categorie):
        ?>
        <div class="candidate-category" id="<?= $categorie ?>">
            <h2><?= ucfirst(str_replace('_', ' ', $categorie)) ?></h2>
            <div class="candidates-vertical">
                <?php
                $stmt = $conn->prepare("SELECT * FROM candidats WHERE categorie = ?");
                $stmt->bind_param("s", $categorie);
                $stmt->execute();
                $result = $stmt->get_result();
                
                while ($candidat = $result->fetch_assoc()):
                ?>
                <div class="candidate-card">
                    <img src="uploads/<?= htmlspecialchars($candidat['photo']) ?>" 
                         alt="<?= htmlspecialchars($candidat['nom']) ?>">
                    <h3><?= htmlspecialchars($candidat['nom']) ?></h3>
                    <?php if (!empty($candidat['description'])): ?>
                    <p><?= htmlspecialchars($candidat['description']) ?></p>
                    <?php endif; ?>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php include('footer.php'); ?>