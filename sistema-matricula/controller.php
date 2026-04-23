<?php
/**
 * CONTROLLER - Gerencia a lógica de apresentação e entrada
 */

class MatriculaController {
    
    public function index() {
        $exibirSucesso = false;
        require_once 'view.php';
    }

    public function cadastrar() {
        // Simulação de recebimento de dados
        $dados = [
            'nome'  => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'idade' => filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT),
            'curso' => filter_input(INPUT_POST, 'curso', FILTER_SANITIZE_SPECIAL_CHARS),
            'data'  => date('d/04/2026')
        ];

        $exibirSucesso = true;
        require_once 'view.php';
    }
}
