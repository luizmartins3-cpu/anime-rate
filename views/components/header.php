<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($title) ? $title . ' - Anime Rate' : 'Anime Rate'; ?></title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/components.css">
    <script>
        // Inicialização rápida do tema para evitar flash de cor
        (function() {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            if (savedTheme === 'light') {
                document.documentElement.classList.add('light-theme');
            }
        })();
    </script>
</head>
<body class="<?php echo isset($_COOKIE['theme']) && $_COOKIE['theme'] === 'light' ? 'light-theme' : ''; ?>">
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="nav-logo">
                <i class="fas fa-play-circle" style="color: var(--primary-color);"></i>
                Anime<span>Rate</span>
            </a>
            <div class="nav-links">
                <a href="/" class="nav-link">Início</a>
                <a href="/login" class="nav-link">Entrar</a>
                <a href="/register" class="btn btn-primary" style="padding: 0.6rem 1.2rem;">Cadastrar</a>
                <button id="theme-toggle-btn" class="theme-toggle" title="Alternar tema">
                    <i class="fas fa-sun"></i>
                </button>
            </div>
        </div>
    </nav>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const themeBtn = document.getElementById('theme-toggle-btn');
            if (!themeBtn) return;
            
            const icon = themeBtn.querySelector('i');
            
            // Sincronizar tema inicial do body com o documentElement
            if (document.documentElement.classList.contains('light-theme')) {
                document.body.classList.add('light-theme');
                if (icon) icon.classList.replace('fa-sun', 'fa-moon');
            }

            themeBtn.addEventListener('click', () => {
                const isLight = document.body.classList.toggle('light-theme');
                document.documentElement.classList.toggle('light-theme');
                localStorage.setItem('theme', isLight ? 'light' : 'dark');
                
                // Salvar em cookie para o PHP ler (evita flash no carregamento do servidor)
                document.cookie = `theme=${isLight ? 'light' : 'dark'}; path=/; max-age=31536000`;

                if (icon) {
                    if (isLight) {
                        icon.classList.replace('fa-sun', 'fa-moon');
                    } else {
                        icon.classList.replace('fa-moon', 'fa-sun');
                    }
                }
            });
        });
    </script>
