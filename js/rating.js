// js/rating.js - Rating page logic

document.addEventListener('DOMContentLoaded', () => {
    // Check Auth
    AnimeAuth.requireAuth();

    // Initialize Navbar
    AnimeUtils.createNavbar();

    const animeId = parseInt(AnimeUtils.getUrlParam('id'));
    const animeHeader = document.getElementById('anime-header');
    const ratingForm = document.getElementById('rating-form');
    const stars = document.querySelectorAll('#star-rating i');
    const starsInput = document.getElementById('stars-value');
    const successMsg = document.getElementById('success-msg');
    
    // Auth info
    const currentUser = AnimeAuth.getCurrentUser();
    const emailInput = document.getElementById('email');
    
    if (currentUser && emailInput) {
        emailInput.value = currentUser.email;
        emailInput.readOnly = true;
        emailInput.style.opacity = '0.7';
        emailInput.title = 'Usando seu e-mail de conta';
    }

    if (!animeId) {
        window.location.href = '../index.html';
        return;
    }

    const anime = animeData.find(a => a.id === animeId);

    if (!anime) {
        window.location.href = '../index.html';
        return;
    }

    // Render anime header
    const imageSrc = anime.image.startsWith('http') ? anime.image : `../${anime.image}`;
    animeHeader.innerHTML = `
        <img src="${imageSrc}" alt="${anime.name}" onerror="this.src='https://via.placeholder.com/150x220?text=Capa'">
        <h2>Avaliar: ${anime.name}</h2>
        <p style="color: var(--text-muted);">${anime.genres.join(', ')}</p>
    `;

    // Star rating logic
    stars.forEach(star => {
        star.addEventListener('mouseover', () => {
            const val = parseInt(star.dataset.value);
            highlightStars(val);
        });

        star.addEventListener('click', () => {
            const val = parseInt(star.dataset.value);
            starsInput.value = val;
            highlightStars(val, true);
        });
    });

    document.getElementById('star-rating').addEventListener('mouseleave', () => {
        const currentVal = parseInt(starsInput.value);
        highlightStars(currentVal);
    });

    function highlightStars(val, isSelection = false) {
        stars.forEach(star => {
            const starVal = parseInt(star.dataset.value);
            if (starVal <= val) {
                star.classList.replace('far', 'fas');
                star.classList.add('selected');
            } else {
                star.classList.replace('fas', 'far');
                star.classList.remove('selected');
            }
        });
    }

    // Form submission
    ratingForm.addEventListener('submit', (e) => {
        e.preventDefault();

        const email = document.getElementById('email').value;
        const starsVal = parseInt(starsInput.value);
        const comment = document.getElementById('comment').value;

        if (starsVal === 0) {
            alert('Por favor, selecione uma nota.');
            return;
        }

        const review = {
            animeId: animeId,
            animeName: anime.name,
            userEmail: email,
            stars: starsVal,
            comment: comment
        };

        AnimeUtils.addReview(review);

        // UI Feedback
        ratingForm.classList.add('hidden');
        successMsg.classList.remove('hidden');

        // Redirect after 2 seconds
        setTimeout(() => {
            window.location.href = `details.html?id=${animeId}`;
        }, 2000);
    });
});
