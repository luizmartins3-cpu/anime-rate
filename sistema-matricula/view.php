<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema de Matrícula</title>
</head>
<body>
    <h1>Nova Matrícula</h1>

    <?php if (isset($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>

    <?php if (isset($_GET['status']) && $_GET['status'] === 'success'): ?>
        <p style="color: green;">Matrícula realizada com sucesso!</p>
    <?php endif; ?>

    <form action="index.php?action=store" method="POST">
        <input type="text" name="nome" placeholder="Nome Completo"><br>
        <input type="number" name="idade" placeholder="Idade"><br>
        <select name="curso">
            <option value="">Selecione um curso</option>
            <option value="PHP">PHP Avançado</option>
            <option value="Laravel">Framework Laravel</option>
        </select><br>
        <button type="submit">Enviar</button>
    </form>

    <h2>Matrículas Realizadas</h2>
    <ul>
        <?php foreach ($matriculas as $m): ?>
            <li><?php echo "{$m->nome} - {$m->curso} ({$m->data})"; ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
