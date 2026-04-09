// js/profile.js - Profile page logic

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Navbar
    AnimeUtils.createNavbar();

    const countFavs = document.getElementById('count-favorites');
    const countReviews = document.getElementById('count-reviews');
    const userRank = document.getElementById('user-rank');
    const reviewsList = document.getElementById('user-reviews-list');

    const favorites = AnimeUtils.getFavorites();
    const reviews = AnimeUtils.getReviews();

    // Update stats
    countFavs.textContent = favorites.length;
    countReviews.textContent = reviews.length;

    // Update Rank
    if (reviews.length > 20) {
        userRank.textContent = 'Mestre dos Animes';
    } else if (reviews.length > 10) {
        userRank.textContent = 'Veterano';
    } else if (reviews.length > 5) {
        userRank.textContent = 'Apreciador';
    } else {
        userRank.textContent = 'Iniciante';
    }

    // Render Recent Reviews
    if (reviews.length === 0) {
        reviewsList.innerHTML = '<p style="color: var(--text-muted); text-align: center;">Você ainda não fez nenhuma avaliação.</p>';
    } else {
        // Show last 5 reviews
        const recentReviews = [...reviews].reverse().slice(0, 5);
        
        recentReviews.forEach(review => {
            const anime = animeData.find(a => a.id === review.animeId);
            const reviewHtml = `
                <div class="review-card fade-in">
                    <div class="review-meta">
                        <span class="review-user" style="color: var(--text-light);">${anime ? anime.name : 'Anime Desconhecido'}</span>
                        <span class="review-date">${review.date}</span>
                    </div>
                    <div class="stars" style="margin-bottom: 0.5rem;">
                        ${Array(5).fill(0).map((_, i) => `<i class="${i < review.stars ? 'fas' : 'far'} fa-star"></i>`).join('')}
                    </div>
                    <p class="review-text">${review.comment}</p>
                    <a href="details.html?id=${review.animeId}" class="btn btn-outline" style="margin-top: 1rem; padding: 0.4rem 1rem; font-size: 0.8rem;">Ver Anime</a>
                </div>
            `;
            reviewsList.insertAdjacentHTML('beforeend', reviewHtml);
        });
    }
});
