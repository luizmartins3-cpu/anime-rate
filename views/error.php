<?php require __DIR__ . '/components/header.php'; ?>

<div class="container" style="text-align: center; margin-top: 5rem;">
    <i class="fas fa-exclamation-triangle fa-5x" style="color: var(--primary-color); margin-bottom: 2rem;"></i>
    <h1 style="font-size: 2.5rem; margin-bottom: 1rem;">Ops! Algo deu errado.</h1>
    <p style="font-size: 1.2rem; color: var(--text-muted); margin-bottom: 3rem;"><?php echo $error ?? 'Ocorreu um erro inesperado.'; ?></p>
    <a href="/" class="btn btn-primary">Voltar para o Início</a>
</div>

<?php require __DIR__ . '/components/footer.php'; ?>
