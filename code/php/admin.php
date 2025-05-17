<?php
include('admin_auth.php');
include('admin_header.php');
?>

<section class="admin-upload">
    <h2>Ajouter un Candidat</h2>
    <form action="upload_candidat.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Nom complet*</label>
            <input type="text" name="nom" required>
        </div>
        
        <div class="form-group">
            <label>Catégorie*</label>
            <select name="categorie" required>
                <option value="leader">Leader Inspirant</option>
                <option value="etudiants">Meilleurs Étudiants</option>
                <option value="binome">Meilleur Binôme</option>
                <!-- Ajoutez d'autres catégories -->
            </select>
        </div>
        
        <div class="form-group">
            <label>Photo* (format carré)</label>
            <input type="file" name="photo" accept="image/*" required>
        </div>
        
        <div class="form-group">
            <label>Description</label>
            <textarea name="description" rows="3"></textarea>
        </div>
        
        <button type="submit" class="btn-upload">Valider</button>
    </form>
</section>

<section class="candidats-list">
    <h2>Candidats Existants</h2>
    <div class="filter-categories">
        <!-- Filtre par catégorie -->
    </div>
    <table>
        <!-- Liste des candidats avec option de suppression -->
    </table>
</section>

<?php include('admin_footer.php'); ?>