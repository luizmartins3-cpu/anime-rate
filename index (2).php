<?php

// index.php - Ponto de entrada e Container DI
require_once 'Database.php';
require_once 'AvaliacaoRepository.php';
require_once 'AvaliacaoService.php';
require_once 'AvaliacaoController.php';
require_once 'middleware.php';

// Inicialização de Dependências
$db = Database::getInstance()->getConnection();
$repository = new AvaliacaoRepository($db);
$service = new AvaliacaoService($repository);
$controller = new AvaliacaoController($service);

// Roteamento
$action = $_GET['action'] ?? 'list';

if ($action === 'store' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->store();
} else {
    $controller->index();
}
