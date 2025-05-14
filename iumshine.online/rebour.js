
    const targetTime = new Date().getTime() + 2 * 60 * 1000; // exemple : 2 minutes

    const interval = setInterval(() => {
        const now = new Date().getTime();
        const diff = targetTime - now;

        if (diff <= 0) {
            clearInterval(interval);
            window.location.href = "nominer.html"; // Redirection vers ta page
        } else {
            const min = Math.floor(diff / 60000);
            const sec = Math.floor((diff % 60000) / 1000);
            document.getElementById("countdown").innerText = `Ouverture dans ${min} min ${sec} sec`;
        }
    }, 1000);
