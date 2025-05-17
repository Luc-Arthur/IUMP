// Navigation entre les onglets
document.addEventListener('DOMContentLoaded', () => {
    // Gestion des onglets
    const links = document.querySelectorAll('.admin-header nav a');
    const sections = document.querySelectorAll('.admin-section');
    
    links.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = link.getAttribute('href');
            
            // Mise à jour de l'onglet actif
            links.forEach(l => l.classList.remove('active'));
            link.classList.add('active');
            
            // Affichage de la section cible
            sections.forEach(section => {
                section.style.display = 'none';
            });
            document.querySelector(target).style.display = 'block';
        });
    });
    
    // Activer la première section par défaut
    if (sections.length > 0) {
        sections[0].style.display = 'block';
    }
    
    // Confirmation pour les actions critiques
    const deleteForms = document.querySelectorAll('form[action="delete_candidate.php"]');
    deleteForms.forEach(form => {
        form.addEventListener('submit', (e) => {
            if (!confirm('Êtes-vous sûr de vouloir supprimer ce candidat ?')) {
                e.preventDefault();
            }
        });
    });
});

// Navigation par onglets sans rechargement
document.addEventListener('DOMContentLoaded', () => {
    const tabs = document.querySelectorAll('.admin-tabs a:not(.logout-tab)');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();
            const url = new URL(tab.href);
            window.history.pushState({}, '', url);
            loadTab(url.searchParams.get('tab'));
        });
    });

    function loadTab(tab) {
        // Mettre à jour l'onglet actif
        tabs.forEach(t => t.classList.toggle('active', t.getAttribute('href').includes(`tab=${tab}`)));
        
        // Ici vous pourriez charger le contenu en AJAX pour plus de performance
        // Mais dans notre cas, le rechargement classique est suffisant
    }
     // Dans le JS
    function loadTab(tab) {
        document.querySelector('.tab-content').innerHTML = '<div class="loader">Chargement...</div>';
        // ... requête AJAX ici ...
    }
});