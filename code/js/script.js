// Menu mobile
document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    navToggle.addEventListener('click', () => {
        const isVisible = navLinks.getAttribute('data-visible') === "true";
        navLinks.setAttribute('data-visible', !isVisible);
        navToggle.setAttribute('aria-expanded', !isVisible);
    });

    // Confettis
    setTimeout(() => {
        confetti({
            particleCount: 150,
            spread: 100,
            origin: { y: 0.6 },
            colors: ['#bb0000', '#ffffff', '#ffaa00', '#44cc44', '#3366ff']
        });
    }, 600);
});

// Carousel automatique horizontal
document.addEventListener('DOMContentLoaded', () => {
    const hSlides = document.querySelector('.h-slides');
    const slides = document.querySelectorAll('.h-slides img');
    const slideWidth = slides[0].clientWidth;
    let currentPosition = 0;
    
    // Clone les images pour l'effet infini
    slides.forEach(slide => {
        const clone = slide.cloneNode(true);
        hSlides.appendChild(clone);
    });
    
    function moveSlides() {
        currentPosition -= 1;
        if (currentPosition <= -slideWidth * slides.length) {
            currentPosition = 0;
            hSlides.style.transition = 'none';
            hSlides.style.transform = `translateX(${currentPosition}px)`;
            setTimeout(() => {
                hSlides.style.transition = 'transform 0.5s linear';
            }, 10);
        } else {
            hSlides.style.transform = `translateX(${currentPosition}px)`;
        }
    }
    
    setInterval(moveSlides, 30);
});
// Menu mobile amélioré
document.addEventListener('DOMContentLoaded', () => {
    const navToggle = document.querySelector('.nav-toggle');
    const navLinks = document.querySelector('.nav-links');

    navToggle.addEventListener('click', () => {
        const isVisible = navLinks.getAttribute('data-visible') === "true";
        navLinks.setAttribute('data-visible', !isVisible);
        navToggle.setAttribute('aria-expanded', !isVisible);
        
        // Animation supplémentaire
        if (!isVisible) {
            navLinks.style.transform = 'translateY(0)';
        } else {
            navLinks.style.transform = 'translateY(-100%)';
        }
    });

    // Confettis au survol du titre
    document.querySelector('.welcome-text').addEventListener('mouseover', () => {
        confetti({
            particleCount: 50,
            spread: 70,
            origin: { y: 0.6 }
        });
    });
});