<?php

// Autoload simples
spl_autoload_register(function ($class) {
    // Tenta o caminho original (Case Sensitive)
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
        return;
    }

    // Tenta com o nome da pasta em minúsculo (Comum em Linux quando o namespace é Upper e a pasta Lower)
    $parts = explode('\\', $class);
    if (count($parts) > 1) {
        $parts[0] = strtolower($parts[0]);
        $file = __DIR__ . '/' . implode('/', $parts) . '.php';
        if (file_exists($file)) {
            require $file;
        }
    }
});

require __DIR__ . '/routes/middleware.php';

// Roteamento básico
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);

use Repositories\AnimeRepository;
use Services\AnimeService;
use Controllers\AnimeController;

// Instanciação manual para Injeção de Dependência
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
