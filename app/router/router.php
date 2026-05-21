<?php

use Core\Database;
use Repositories\AnimeRepository;
use Services\AnimeService;
use Controllers\AnimeController;
use Repositories\AvaliacaoRepository;
use Services\AvaliacaoService;
use Controllers\AvaliacaoController;

// Inicialização de Dependências
$db = Database::getInstance()->getConnection();

// Anime Dependencies
$animeRepository = new AnimeRepository();
$animeService = new AnimeService($animeRepository);
$animeController = new AnimeController($animeService);

// Avaliacao Dependencies
$avaliacaoRepository = new AvaliacaoRepository($db);
$avaliacaoService = new AvaliacaoService($avaliacaoRepository);
$avaliacaoController = new AvaliacaoController($avaliacaoService);

// Roteamento
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$action = $_GET['action'] ?? null;

// Rota de Feedback/Avaliação
if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $avaliacaoController->store();
    exit;
} elseif ($action === 'list') {
    $avaliacaoController->index();
    exit;
}

// Rotas Principais
switch ($path) {
    case '/':
    case '/index.php':
    case '/home':
        $animeController->index();
        break;
    
    case '/details':
        $id = $_GET['id'] ?? null;
        $animeController->details($id);
        break;

    case '/login':
        require __DIR__ . '/../../view/login.php';
        break;

    case '/register':
        require __DIR__ . '/../../view/register.php';
        break;

    default:
        // Se for uma requisição para um arquivo que existe em view/, podemos tentar servir?
        // Mas o index.php deve ser o único ponto de entrada.
        http_response_code(404);
        echo "Página não encontrada: " . $path;
        break;
}
