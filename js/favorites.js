// js/favorites.js - Favorites page logic

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Navbar
    AnimeUtils.createNavbar();

    const grid = document.getElementById('favorites-grid');
    const emptyMsg = document.getElementById('empty-favs');

    function renderFavorites() {
        const favoriteIds = AnimeUtils.getFavorites();
        const favorites = animeData.filter(anime => favoriteIds.includes(anime.id));

        grid.innerHTML = '';

        if (favorites.length === 0) {
            emptyMsg.classList.remove('hidden');
        } else {
            emptyMsg.classList.add('hidden');
            
            favorites.forEach(anime => {
                const cardHtml = `
                    <article class="anime-card fade-in">
                        <div class="favorite-btn active" data-id="${anime.id}">
                            <i class="fas fa-heart"></i>
                        </div>
                        <div class="card-img">
                            <img src="${anime.image}" alt="${anime.name}">
                            <div class="card-badge">
                                <i class="fas fa-star"></i> ${anime.rating}
                            </div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">${anime.name}</h3>
                            <div class="card-genres">${anime.genres.join(', ')}</div>
                            <div class="card-actions">
                                <a href="details.html?id=${anime.id}" class="btn btn-primary">Ver mais</a>
                                <a href="rating.html?id=${anime.id}" class="btn btn-secondary">Avaliar</a>
                            </div>
                        </div>
                    </article>
                `;
                grid.insertAdjacentHTML('beforeend', cardHtml);
            });

            // Re-add events to remove from favorites
            document.querySelectorAll('.favorite-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const animeId = parseInt(btn.dataset.id);
                    AnimeUtils.toggleFavorite(animeId);
                    
                    // Re-render to update the list
                    renderFavorites();
                });
            });
        }
    }

    renderFavorites();
});
