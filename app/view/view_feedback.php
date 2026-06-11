<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - Anime Rate</title>
    <!-- Reaproveitando estilos do projeto original -->
    <link rel="stylesheet" href="view/css/style.css">
    <style>
        .feedback-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: var(--bg-card);
            border-radius: 12px;
            text-align: center;
            border: 1px solid var(--border-color);
        }
        .error-box { color: #ff4d4d; border-left: 4px solid #ff4d4d; padding: 10px; background: rgba(255, 77, 77, 0.1); margin-bottom: 20px; }
        .success-box { color: #44ff44; border-left: 4px solid #44ff44; padding: 10px; background: rgba(68, 255, 68, 0.1); margin-bottom: 20px; }
        .btn-back { display: inline-block; margin-top: 20px; padding: 10px 20px; background: var(--primary-color); color: white; border-radius: 6px; text-decoration: none; }
        .review-item { text-align: left; border-bottom: 1px solid var(--border-color); padding: 15px 0; }
        .stars { color: #f1c40f; }
    </style>
</head>
<body>
    <div class="feedback-container">
        <?php if (isset($erro)): ?>
            <div class="error-box">
                <strong>Erro:</strong> <?php echo $erro; ?>
            </div>
            <a href="javascript:history.back()" class="btn-back">Voltar e Corrigir</a>
        <?php elseif (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
            <div class="success-box">
                Sua avaliação foi enviada com sucesso ao nosso banco de dados!
            </div>
            <a href="/" class="btn-back">Voltar ao Início</a>
        <?php endif; ?>

        <h2>Avaliações Recentes (BD)</h2>
        <div class="reviews-list">
            <?php if (empty($avaliacoes)): ?>
                <p>Nenhuma avaliação encontrada no banco ainda.</p>
            <?php else: ?>
                <?php foreach ($avaliacoes as $a): ?>
                    <div class="review-item">
                        <strong><?php echo $a->anime_name; ?></strong> 
                        <span class="stars"><?php echo str_repeat('★', $a->stars); ?></span><br>
                        <small><?php echo $a->user_email; ?> em <?php echo date('d/m/Y H:i', strtotime($a->created_at)); ?></small>
                        <p><?php echo $a->comment; ?></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
