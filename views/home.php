<?php require __DIR__ . '/components/header.php'; ?>

<div class="fade-in">
    <main class="container">
        <!-- Hero Banner -->
        <section class="hero-banner">
            <img src="/images/hero-banner.jpg" alt="Banner Hero Anime">
            <div class="hero-content">
                <h1 class="hero-title">Descubra seu próximo anime favorito</h1>
                <p class="hero-desc">Explore milhares de títulos, avalie suas obras preferidas e organize sua lista personalizada com a melhor comunidade otaku.</p>
                <div class="hero-actions">
                    <a href="#anime-grid" class="btn btn-primary">Começar a Explorar <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </section>

        <!-- Controls (Search and Filters) -->
        <section class="controls-container">
            <div class="search-bar">
                <i class="fas fa-search"></i>
                <input type="text" id="search-input" placeholder="Pesquisar por título, gênero ou estúdio...">
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 1rem;">
                <button id="toggle-genres-btn" class="btn btn-secondary" style="padding: 0.5rem 1rem; font-size: 0.85rem;">
                    <i class="fas fa-filter"></i> Filtrar por Gênero
                </button>
            </div>

            <div class="filter-group hidden" id="genre-filters">
                <div class="filter-btn active" data-genre="all">Todos</div>
                <div class="filter-btn" data-genre="Ação">Ação</div>
                <div class="filter-btn" data-genre="Aventura">Aventura</div>
                <div class="filter-btn" data-genre="Comédia">Comédia</div>
                <div class="filter-btn" data-genre="Drama">Drama</div>
                <div class="filter-btn" data-genre="Escolar">Escolar</div>
                <div class="filter-btn" data-genre="Esporte">Esporte</div>
                <div class="filter-btn" data-genre="Fantasia">Fantasia</div>
                <div class="filter-btn" data-genre="Isekai">Isekai</div>
                <div class="filter-btn" data-genre="Romance">Romance</div>
                <div class="filter-btn" data-genre="Shounen">Shounen</div>
                <div class="filter-btn" data-genre="Sobrenatural">Sobrenatural</div>
            </div>
        </section>

        <div id="main-content">
            <div class="anime-grid" id="anime-grid">
                <?php foreach ($animes as $anime): ?>
                <div class="anime-card" onclick="window.location.href='/details?id=<?php echo $anime->id; ?>'">
                    <div class="anime-poster">
                        <img src="<?php echo $anime->image; ?>" alt="<?php echo $anime->name; ?>">
                        <div class="anime-rating">
                            <i class="fas fa-star"></i>
                            <span><?php echo $anime->rating; ?></span>
                        </div>
                    </div>
                    <div class="anime-info">
                        <h3 class="anime-title"><?php echo $anime->name; ?></h3>
                        <p class="anime-desc"><?php echo $anime->description; ?></p>
                        <div class="anime-meta">
                            <span><i class="fas fa-play-circle"></i> <?php echo $anime->episodes; ?> Eps</span>
                            <span><i class="fas fa-calendar"></i> <?php echo $anime->seasons; ?> Temp</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php if (empty($animes)): ?>
        <div id="empty-state" class="empty-message">
            <i class="fas fa-search-minus fa-3x" style="margin-bottom: 1.5rem; color: var(--primary-color); opacity: 0.5;"></i>
            <h3>Nenhum anime encontrado</h3>
            <p>Ainda não há animes cadastrados no banco de dados.</p>
        </div>
        <?php endif; ?>
    </main>
</div>

<script>
    // Manter a funcionalidade visual dos filtros
    document.getElementById('toggle-genres-btn').addEventListener('click', () => {
        document.getElementById('genre-filters').classList.toggle('hidden');
    });

    // Filtro simples via JS para manter a experiência (opcional, pode ser movido para PHP)
    document.getElementById('search-input').addEventListener('input', (e) => {
        const term = e.target.value.toLowerCase();
        document.querySelectorAll('.anime-card').forEach(card => {
            const title = card.querySelector('.anime-title').textContent.toLowerCase();
            card.style.display = title.includes(term) ? 'block' : 'none';
        });
    });
</script>

<?php require __DIR__ . '/components/footer.php'; ?>
