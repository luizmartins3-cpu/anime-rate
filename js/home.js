// js/home.js - Home page logic

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Navbar
    AnimeUtils.createNavbar();

    const animeGrid = document.getElementById('anime-grid');
    const searchInput = document.getElementById('search-input');
    const genreFilters = document.querySelectorAll('.filter-btn');
    const emptyState = document.getElementById('empty-state');

    let currentFilter = 'all';
    let searchQuery = '';

    /**
     * Render anime cards based on filtered data
     */
    function renderAnimes() {
        // Filter animes by genre and search query
        const filteredAnimes = animeData.filter(anime => {
            const matchesGenre = currentFilter === 'all' || anime.genres.includes(currentFilter);
            const matchesSearch = anime.name.toLowerCase().includes(searchQuery.toLowerCase());
            return matchesGenre && matchesSearch;
        });

        // Clear grid
        animeGrid.innerHTML = '';

        if (filteredAnimes.length === 0) {
            emptyState.classList.remove('hidden');
        } else {
            emptyState.classList.add('hidden');
            
            filteredAnimes.forEach(anime => {
                const isFav = AnimeUtils.isFavorite(anime.id);
                const cardHtml = `
                    <article class="anime-card">
                        <div class="favorite-btn ${isFav ? 'active' : ''}" data-id="${anime.id}">
                            <i class="${isFav ? 'fas' : 'far'} fa-heart"></i>
                        </div>
                        <div class="card-img">
                            <img src="${anime.image}" alt="${anime.name}" loading="lazy">
                            <div class="card-badge">
                                <i class="fas fa-star"></i> ${anime.rating}
                            </div>
                        </div>
                        <div class="card-content">
                            <h3 class="card-title">${anime.name}</h3>
                            <div class="card-genres">${anime.genres.join(', ')}</div>
                            <div class="card-actions">
                                <a href="pages/details.html?id=${anime.id}" class="btn btn-primary">Ver mais</a>
                                <a href="pages/rating.html?id=${anime.id}" class="btn btn-secondary">Avaliar</a>
                            </div>
                        </div>
                    </article>
                `;
                animeGrid.insertAdjacentHTML('beforeend', cardHtml);
            });

            // Add events to favorite buttons
            document.querySelectorAll('.favorite-btn').forEach(btn => {
                btn.addEventListener('click', (e) => {
                    e.preventDefault();
                    const animeId = parseInt(btn.dataset.id);
                    const isActive = AnimeUtils.toggleFavorite(animeId);
                    
                    const icon = btn.querySelector('i');
                    if (isActive) {
                        btn.classList.add('active');
                        icon.classList.replace('far', 'fas');
                    } else {
                        btn.classList.remove('active');
                        icon.classList.replace('fas', 'far');
                    }
                });
            });
        }
    }

    // Search event
    searchInput.addEventListener('input', (e) => {
        searchQuery = e.target.value;
        renderAnimes();
    });

    // Genre filter events
    genreFilters.forEach(btn => {
        btn.addEventListener('click', () => {
            // Update active state
            genreFilters.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            currentFilter = btn.dataset.genre;
            renderAnimes();
        });
    });

    // Initial render
    renderAnimes();
});
