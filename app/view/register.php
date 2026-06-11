<?php 
$title = 'Criar Conta';
require __DIR__ . '/components/header.php'; 
?>

<style>
    .auth-container {
        max-width: 480px;
        margin: 6rem auto;
        background: var(--bg-card);
        padding: 3.5rem;
        border-radius: 32px;
        box-shadow: 0 30px 60px rgba(0, 0, 0, 0.3);
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
        background: var(--title-gradient);
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
        background: var(--bg-glass);
        border: 1px solid var(--glass-border);
        border-radius: 16px;
        color: var(--text-light);
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .form-group input:focus {
        border-color: var(--primary-color);
        background: var(--bg-glass);
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

<div class="fade-in">
    <main class="container">
        <div class="auth-container">
            <div class="auth-header">
                <h1>Criar Conta</h1>
                <p>Junte-se à maior comunidade otaku!</p>
            </div>

            <div id="error-msg" class="error-message"></div>

            <form id="register-form">
                <div class="form-group">
                    <label for="name">Nome Completo</label>
                    <input type="text" id="name" placeholder="Como quer ser chamado?" required>
                </div>

                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" placeholder="seu@email.com" required>
                </div>

                <div class="form-group">
                    <label for="password">Senha</label>
                    <input type="password" id="password" placeholder="Mínimo 6 caracteres" required minlength="6">
                </div>

                <button type="submit" class="btn btn-primary auth-btn">Registrar Agora</button>
            </form>

            <div class="auth-footer">
                Já tem uma conta? <a href="/login">Fazer Login</a>
            </div>
        </div>
    </main>
</div>

<!-- Scripts -->
<script src="app/view/js/auth.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('register-form');
        const errorMsg = document.getElementById('error-msg');

        form.addEventListener('submit', (e) => {
            e.preventDefault();
            errorMsg.style.display = 'none';

            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (window.AnimeAuth) {
                const result = AnimeAuth.register(name, email, password);
                if (result.success) {
                    AnimeAuth.login(email, password);
                    window.location.href = '/';
                } else {
                    errorMsg.textContent = result.message;
                    errorMsg.style.display = 'block';
                }
            }
        });
    });
</script>

<?php require __DIR__ . '/components/footer.php'; ?>
