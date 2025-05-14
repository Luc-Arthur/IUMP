
// function scrollToForm(category) {
    // const categoryInput = document.getElementById('category');
    // categoryInput.value = category;
    // document.getElementById('form').scrollIntoView({ behavior: 'smooth' });


document.querySelector('form').addEventListener('submit', function (e) {
    if (!document.getElementById('name').value || !document.getElementById('email').value || !document.getElementById('category').value) {
        e.preventDefault();
        alert("Veuillez remplir tous les champs avant de soumettre.");
    }
});

window.onbeforeunload = function () {
    return "Vous quittez la page sans avoir soumis le formulaire. Vos données pourraient être perdues.";
};

document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    navToggle.addEventListener('click', () => {
        const isVisible = navLinks.getAttribute('data-visible') === "true";

        // Basculer l'état
        navLinks.setAttribute('data-visible', !isVisible);
        navToggle.setAttribute('aria-expanded', !isVisible);

        // Animation optionnelle
        if (!isVisible) {
            navLinks.style.animation = 'slideDown 0.3s ease-out';
        }
    });
});