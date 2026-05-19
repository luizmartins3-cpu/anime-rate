<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Entrar - Anime Rate</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/components.css">
    <style>
        .auth-container {
            max-width: 480px;
            margin: 6rem auto;
            background: var(--bg-card);
            padding: 3.5rem;
            border-radius: 32px;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.5);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(20px);
        }

        .auth-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .auth-header h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.75rem;
            letter-spacing: -0.05em;
            background: linear-gradient(to right, #fff, #94a3b8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .auth-header p {
            color: var(--text-muted);
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 2rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.75rem;
            color: var(--text-light);
            font-weight: 600;
            font-size: 0.95rem;
        }

        .form-group input {
            width: 100%;
            padding: 1.1rem 1.25rem;
            background: rgba(15, 23, 42, 0.4);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            color: var(--text-light);
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            border-color: var(--primary-color);
            background: rgba(15, 23, 42, 0.7);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        .auth-btn {
            width: 100%;
            margin-top: 1.5rem;
            padding: 1.1rem;
            font-size: 1.1rem;
            font-weight: 700;
        }

        .auth-footer {
            text-align: center;
            margin-top: 2.5rem;
            color: var(--text-muted);
            font-size: 0.95rem;
        }

        .auth-footer a {
            color: var(--primary-color);
            font-weight: 700;
        }

        .auth-footer a:hover {
            color: var(--text-light);
        }

        .error-message {
            background: rgba(244, 63, 94, 0.1);
            color: var(--accent-color);
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            text-align: center;
            font-size: 0.9rem;
            font-weight: 600;
            border: 1px solid rgba(244, 63, 94, 0.2);
            display: none;
        }
    </style>
</head>
<body>
    <div class="fade-in">
        <main class="container">
            <div class="auth-container">
                <div class="auth-header">
                    <h1>Entrar</h1>
                    <p>Bem-vindo de volta ao Anime Rate!</p>
                </div>

                <div id="error-msg" class="error-message"></div>

                <form id="login-form">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" placeholder="seu@email.com" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Senha</label>
                        <input type="password" id="password" placeholder="Sua senha secreta" required>
                    </div>

                    <button type="submit" class="btn btn-primary auth-btn">Acessar Conta</button>
                </form>

                <div class="auth-footer">
                    Ainda não tem conta? <a href="register.html">Criar Conta Agora</a>
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="../js/auth.js"></script>
    <script src="../js/common.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            AnimeUtils.createNavbar();
            
            const form = document.getElementById('login-form');
            const errorMsg = document.getElementById('error-msg');

            form.addEventListener('submit', (e) => {
                e.preventDefault();
                errorMsg.style.display = 'none';

                const email = document.getElementById('email').value;
                const password = document.getElementById('password').value;

                const result = AnimeAuth.login(email, password);

                if (result.success) {
                    const redirect = AnimeUtils.getUrlParam('redirect');
                    window.location.href = redirect || 'profile.html';
                } else {
                    errorMsg.textContent = result.message;
                    errorMsg.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>
