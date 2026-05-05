<?php 
$title = $anime->name;
require __DIR__ . '/components/header.php'; 
?>

<style>
    .details-header { display: grid; grid-template-columns: 380px 1fr; gap: 4rem; margin-top: 3rem; align-items: start; }
    .details-img { border-radius: 24px; overflow: hidden; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.6); border: 1px solid var(--glass-border); position: sticky; top: 100px; }
    .details-img img { width: 100%; height: auto; transition: transform 0.5s ease; }
    .details-info h1 { font-size: 3.5rem; font-weight: 900; margin-bottom: 1.5rem; letter-spacing: -0.05em; line-height: 1.1; background: linear-gradient(to right, #fff, #94a3b8); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
    .details-meta { display: flex; gap: 1rem; margin-bottom: 2.5rem; flex-wrap: wrap; }
    .meta-item { display: flex; align-items: center; gap: 0.6rem; color: var(--text-light); background: rgba(255, 255, 255, 0.05); padding: 0.6rem 1.25rem; border-radius: 12px; font-weight: 600; font-size: 0.9rem; border: 1px solid var(--glass-border); backdrop-filter: blur(10px); }
    .meta-item i { color: var(--primary-color); }
    .details-description { font-size: 1.15rem; color: var(--text-muted); margin-bottom: 3rem; line-height: 1.8; max-width: 800px; }
    .trailer-section { margin-top: 6rem; padding-top: 4rem; border-top: 1px solid var(--glass-border); }
    .video-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 32px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5); border: 1px solid var(--glass-border); }
    .video-container iframe { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; }
</style>

<div class="fade-in">
    <main class="container">
        <a href="/" class="btn btn-secondary" style="margin-bottom: 2rem;">
            <i class="fas fa-arrow-left"></i> Voltar à Galeria
        </a>

        <div class="details-header">
            <div class="details-img">
                <img src="<?php echo $anime->image; ?>" alt="<?php echo $anime->name; ?>">
            </div>
            
            <div class="details-info">
                <h1><?php echo $anime->name; ?></h1>
                
                <div class="details-meta">
                    <div class="meta-item"><i class="fas fa-star"></i> <?php echo $anime->rating; ?></div>
                    <div class="meta-item"><i class="fas fa-play-circle"></i> <?php echo $anime->episodes; ?> Episódios</div>
                    <div class="meta-item"><i class="fas fa-calendar"></i> <?php echo $anime->seasons; ?> Temporadas</div>
                </div>

                <div class="details-description">
                    <?php echo nl2br($anime->full_description); ?>
                </div>

                <div class="details-actions">
                    <button class="btn btn-primary btn-lg"><i class="fas fa-heart"></i> Adicionar aos Favoritos</button>
                    <button class="btn btn-secondary btn-lg"><i class="fas fa-share-alt"></i> Compartilhar</button>
                </div>
            </div>
        </div>

        <?php if ($anime->trailer): ?>
        <section class="trailer-section">
            <h2 style="font-size: 2rem; margin-bottom: 2.5rem; font-weight: 800;">Assista ao Trailer</h2>
            <div class="video-container">
                <iframe src="<?php echo $anime->trailer; ?>" allowfullscreen></iframe>
            </div>
        </section>
        <?php endif; ?>
    </main>
</div>

<?php require __DIR__ . '/components/footer.php'; ?>
