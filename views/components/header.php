<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? 'Anime Rate'; ?> - O Melhor Catálogo de Animes</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/components.css">
</head>
<body>
    <nav class="navbar" style="position: sticky; top: 0; z-index: 1000; background: var(--bg-glass); backdrop-filter: blur(12px); border-bottom: 1px solid var(--glass-border); padding: 1rem 0;">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <a href="/" class="nav-logo">Anime<span>Rate</span></a>
            <div class="nav-links" style="display: flex; gap: 2rem; align-items: center;">
                <a href="/" class="nav-link active">Início</a>
                <a href="/login" class="nav-link">Entrar</a>
                <a href="/register" class="btn btn-primary" style="padding: 0.6rem 1.2rem;">Cadastrar</a>
            </div>
        </div>
    </nav>
