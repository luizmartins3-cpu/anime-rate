<?php

require_once 'Database.php';
require_once 'MatriculaRepository.php';
require_once 'MatriculaService.php';
require_once 'MatriculaController.php';
require_once 'middleware.php';

// Container de Injeção de Dependência manual
$db = Database::getInstance()->getConnection();
$repository = new MatriculaRepository($db);
$service = new MatriculaService($repository);
$controller = new MatriculaController($service);

// Roteamento simples
$action = $_GET['action'] ?? 'index';

if ($action === 'store') {
    $controller->store();
} else {
    $controller->index();
}
