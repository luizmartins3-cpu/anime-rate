<?php
/**
 * FRONT CONTROLLER - Ponto de entrada do sistema
 */

require_once 'controller.php';

$controller = new MatriculaController();

// Roteamento simples
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller->cadastrar();
} else {
    $controller->index();
}
