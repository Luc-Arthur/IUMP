
// Compte à rebours
const countdown = document.createElement("div");
countdown.style.textAlign = "center";
countdown.style.padding = "1rem";
countdown.style.fontSize = "1.2rem";
document.querySelector(".event-preview").appendChild(countdown);

function updateCountdown() {
    const eventDate = new Date("2025-06-20T00:00:00").getTime();
    const now = new Date().getTime();
    const distance = eventDate - now;
    if (distance <= 0) {
        countdown.innerHTML = "L'événement a commencé !";
        return;
    }
    const days = Math.floor(distance / (1000 * 60 * 60 * 24));
    const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    countdown.innerHTML = `L'événement commence dans ${days}j ${hours}h ${minutes}m ${seconds}s`;
}
setInterval(updateCountdown, 1000);
updateCountdown();

// Apparition au scroll
const elements = document.querySelectorAll(".hero, .event-preview");
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = 1;
            entry.target.style.transform = "translateY(0)";
        }
    });
}, { threshold: 0.1 });

elements.forEach(el => {
    el.style.opacity = 0;
    el.style.transform = "translateY(50px)";
    el.style.transition = "all 1s ease-out";
    observer.observe(el);
});

// Confettis animation
const canvas = document.getElementById('confetti-canvas');
const ctx = canvas.getContext('2d');
let confettis = [];

function resizeCanvas() {
    canvas.width = document.querySelector('.hero').offsetWidth;
    canvas.height = document.querySelector('.hero').offsetHeight;
}
resizeCanvas();
window.addEventListener('resize', resizeCanvas);

for (let i = 0; i < 100; i++) {
    confettis.push({
        x: Math.random() * canvas.width,
        y: Math.random() * canvas.height,
        r: Math.random() * 6 + 4,
        d: Math.random() * 50,
        color: `hsl(${Math.random() * 360}, 70%, 60%)`,
        tilt: Math.floor(Math.random() * 10) - 10,
        tiltAngle: 0,
        tiltAngleIncremental: Math.random() * 0.07 + 0.05
    });
}

function drawConfettis() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    confettis.forEach(c => {
        ctx.beginPath();
        ctx.lineWidth = c.r / 2;
        ctx.strokeStyle = c.color;
        ctx.moveTo(c.x + c.tilt + c.r / 3, c.y);
        ctx.lineTo(c.x + c.tilt, c.y + c.tilt + c.r / 3);
        ctx.stroke();
    });
    updateConfettis();
}

function updateConfettis() {
    confettis.forEach(c => {
        c.tiltAngle += c.tiltAngleIncremental;
        c.y += (Math.cos(c.d) + 3 + c.r / 2) / 2;
        c.x += Math.sin(c.d);
        c.tilt = Math.sin(c.tiltAngle) * 15;

        if (c.y > canvas.height) {
            c.y = -10;
            c.x = Math.random() * canvas.width;
        }
    });
}

setInterval(drawConfettis, 33);


// Animation des images au scroll
const slideImages = document.querySelectorAll(".slide-from-left, .slide-from-right");

const imageObserver = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add("slide-in");
        }
    });
}, { threshold: 0.2 });

slideImages.forEach(img => imageObserver.observe(img));
