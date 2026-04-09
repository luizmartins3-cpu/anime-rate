// js/details.js - Anime details page logic

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Navbar
    AnimeUtils.createNavbar();

    const container = document.getElementById('details-container');
    const animeId = parseInt(AnimeUtils.getUrlParam('id'));

    if (!animeId) {
        window.location.href = '../index.html';
        return;
    }

    const anime = animeData.find(a => a.id === animeId);

    if (!anime) {
        container.innerHTML = `
            <div class="empty-message">
                <h3>Anime não encontrado</h3>
                <a href="../index.html" class="btn btn-primary">Voltar ao Início</a>
            </div>
        `;
        return;
    }

    // Update document title
    document.title = `${anime.name} - Anime Rate`;

    // Render Details
    const reviews = AnimeUtils.getReviewsByAnime(animeId);
    
    const detailsHtml = `
        <section class="details-header">
            <div class="details-img">
                <img src="${anime.image}" alt="${anime.name}">
            </div>
            <div class="details-info">
                <h1>${anime.name}</h1>
                <div class="details-meta">
                    <div class="meta-item"><i class="fas fa-star"></i> ${anime.rating}</div>
                    <div class="meta-item"><i class="fas fa-layer-group"></i> ${anime.seasons} Temporadas</div>
                    <div class="meta-item"><i class="fas fa-play-circle"></i> ${anime.episodes} Episódios</div>
                    <div class="meta-item"><i class="fas fa-tag"></i> ${anime.genres.join(', ')}</div>
                </div>
                <div class="details-description">
                    <p>${anime.fullDescription}</p>
                </div>
                <div class="details-actions" style="display: flex; gap: 1rem;">
                    <button class="btn btn-primary" id="fav-detail-btn">
                        <i class="${AnimeUtils.isFavorite(animeId) ? 'fas' : 'far'} fa-heart"></i> 
                        ${AnimeUtils.isFavorite(animeId) ? 'Remover dos Favoritos' : 'Adicionar aos Favoritos'}
                    </button>
                    <a href="rating.html?id=${anime.id}" class="btn btn-outline">Avaliar Anime</a>
                </div>
            </div>
        </section>

        <section class="trailer-section">
            <h2 class="section-title">Trailer Oficial</h2>
            <div class="video-container">
                <iframe src="${anime.trailer}" title="YouTube video player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
            </div>
        </section>

        <section class="reviews-section">
            <h2 class="section-title">Avaliações da Comunidade</h2>
            <div id="reviews-list">
                ${reviews.length === 0 ? '<p style="color: var(--text-muted);">Nenhuma avaliação ainda. Seja o primeiro a avaliar!</p>' : ''}
                ${reviews.map(review => `
                    <div class="review-card">
                        <div class="review-meta">
                            <span class="review-user">${review.userEmail}</span>
                            <span class="review-date">${review.date}</span>
                        </div>
                        <div class="stars" style="margin-bottom: 0.5rem;">
                            ${Array(5).fill(0).map((_, i) => `<i class="${i < review.stars ? 'fas' : 'far'} fa-star"></i>`).join('')}
                        </div>
                        <p class="review-text">${review.comment}</p>
                    </div>
                `).join('')}
            </div>
        </section>
    `;

    container.insertAdjacentHTML('beforeend', detailsHtml);

    // Favorite button logic
    const favBtn = document.getElementById('fav-detail-btn');
    favBtn.addEventListener('click', () => {
        const isActive = AnimeUtils.toggleFavorite(animeId);
        const icon = favBtn.querySelector('i');
        
        if (isActive) {
            favBtn.innerHTML = '<i class="fas fa-heart"></i> Remover dos Favoritos';
        } else {
            favBtn.innerHTML = '<i class="far fa-heart"></i> Adicionar aos Favoritos';
        }
    });
});
