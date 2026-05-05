<?php

// Autoload simples
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

require __DIR__ . '/routes/middleware.php';

// Roteamento básico
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

use Repositories\AnimeRepository;
use Services\AnimeService;
use Controllers\AnimeController;

// Instanciação manual para Injeção de Dependência (estilo acadêmico)
$animeRepository = new AnimeRepository();
$animeService = new AnimeService($animeRepository);
$animeController = new AnimeController($animeService);

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
        require __DIR__ . '/views/login.php';
        break;

    case '/register':
        require __DIR__ . '/views/register.php';
        break;

    default:
        http_response_code(404);
        echo "Página não encontrada.";
        break;
}
