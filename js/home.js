// js/home.js - Home page logic

document.addEventListener('DOMContentLoaded', () => {
    // Initialize Navbar
    AnimeUtils.createNavbar();

    const mainContent = document.getElementById('main-content');
    const searchInput = document.getElementById('search-input');
    const genreFilters = document.querySelectorAll('.filter-btn');
    const emptyState = document.getElementById('empty-state');
    
    // Toggle elements
    const toggleGenresBtn = document.getElementById('toggle-genres-btn');
    const genreFiltersContainer = document.getElementById('genre-filters');
    const filterActions = document.getElementById('filter-actions');
    const selectAllBtn = document.getElementById('select-all-btn');
    const clearAllBtn = document.getElementById('clear-all-btn');

    let selectedGenres = new Set();
    let searchQuery = '';

    /**
     * Create an anime card HTML
     */
    function createAnimeCard(anime) {
        const isFav = AnimeUtils.isFavorite(anime.id);
        return `
            <article class="anime-card">
                <div class="favorite-btn ${isFav ? 'active' : ''}" data-id="${anime.id}">
                    <i class="${isFav ? 'fas' : 'far'} fa-heart"></i>
                </div>
                <div class="card-img">
                    <img src="${anime.image}" alt="${anime.name}" loading="lazy" onerror="this.src='https://via.placeholder.com/220x320?text=Capa+Indisponível'">
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
    }

    /**
     * Render anime cards based on filtered data
     */
    function renderAnimes() {
        mainContent.innerHTML = '';

        if (searchQuery !== '') {
            const filteredAnimes = animeData.filter(anime => 
                anime.name.toLowerCase().includes(searchQuery.toLowerCase())
            );

            if (filteredAnimes.length === 0) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
                const section = document.createElement('section');
                section.innerHTML = `
                    <h2 class="section-title" style="margin-bottom: 1.5rem;">Resultados para "${searchQuery}"</h2>
                    <div class="anime-grid">
                        ${filteredAnimes.map(anime => createAnimeCard(anime)).join('')}
                    </div>
                `;
                mainContent.appendChild(section);
            }
        } else {
            const allGenres = [...new Set(animeData.flatMap(anime => anime.genres))].sort();
            const genresToShow = selectedGenres.size === 0 
                ? allGenres 
                : allGenres.filter(g => selectedGenres.has(g));

            let hasResults = false;

            genresToShow.forEach(genre => {
                const animesInGenre = animeData.filter(anime => anime.genres.includes(genre));
                
                if (animesInGenre.length > 0) {
                    hasResults = true;
                    const section = document.createElement('section');
                    section.className = 'genre-section';
                    section.style.marginBottom = '3rem';
                    
                    section.innerHTML = `
                        <h2 class="section-title" style="margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.75rem;">
                            ${genre} <span style="font-size: 0.9rem; font-weight: 500; color: var(--text-muted); opacity: 0.7;">(${animesInGenre.length})</span>
                        </h2>
                        <div class="anime-grid">
                            ${animesInGenre.map(anime => createAnimeCard(anime)).join('')}
                        </div>
                    `;
                    mainContent.appendChild(section);
                }
            });

            if (!hasResults) {
                emptyState.classList.remove('hidden');
            } else {
                emptyState.classList.add('hidden');
            }
        }

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

    // Toggle Genre Panel
    toggleGenresBtn.addEventListener('click', () => {
        const isHidden = genreFiltersContainer.classList.contains('hidden');
        if (isHidden) {
            genreFiltersContainer.classList.remove('hidden');
            filterActions.classList.remove('hidden');
            toggleGenresBtn.innerHTML = '<i class="fas fa-times"></i> Fechar Filtros';
        } else {
            genreFiltersContainer.classList.add('hidden');
            filterActions.classList.add('hidden');
            toggleGenresBtn.innerHTML = '<i class="fas fa-filter"></i> Filtrar por Gênero';
        }
    });

    // Select All Genres
    selectAllBtn.addEventListener('click', () => {
        const allGenres = [...new Set(animeData.flatMap(anime => anime.genres))];
        selectedGenres = new Set(allGenres);
        
        genreFilters.forEach(btn => {
            if (btn.dataset.genre !== 'all') {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
        renderAnimes();
    });

    // Clear All Genres
    clearAllBtn.addEventListener('click', () => {
        selectedGenres.clear();
        genreFilters.forEach(btn => {
            if (btn.dataset.genre === 'all') {
                btn.classList.add('active');
            } else {
                btn.classList.remove('active');
            }
        });
        renderAnimes();
    });

    // Search event
    searchInput.addEventListener('input', (e) => {
        searchQuery = e.target.value;
        renderAnimes();
    });

    // Genre filter events
    genreFilters.forEach(btn => {
        btn.addEventListener('click', () => {
            const genre = btn.dataset.genre;

            if (genre === 'all') {
                selectedGenres.clear();
                genreFilters.forEach(b => b.classList.remove('active'));
                btn.classList.add('active');
            } else {
                document.querySelector('.filter-btn[data-genre="all"]').classList.remove('active');

                if (selectedGenres.has(genre)) {
                    selectedGenres.delete(genre);
                    btn.classList.remove('active');
                } else {
                    selectedGenres.add(genre);
                    btn.classList.add('active');
                }

                if (selectedGenres.size === 0) {
                    document.querySelector('.filter-btn[data-genre="all"]').classList.add('active');
                }
            }

            renderAnimes();
        });
    });

    // Initial render
    renderAnimes();
});
