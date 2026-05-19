<?php

require_once 'MatriculaService.php';
require_once 'BusinessRuleException.php';

class MatriculaController {
    private $service;

    public function __construct(MatriculaService $service) {
        $this->service = $service;
    }

    public function index() {
        $matriculas = $this->service->listarTodas();
        require_once 'view.php';
    }

    public function store() {
        try {
            // Os dados já devem vir sanitizados pelo middleware
            $dados = [
                'nome'  => $_POST['nome'] ?? '',
                'idade' => $_POST['idade'] ?? '',
                'curso' => $_POST['curso'] ?? ''
            ];

            $this->service->salvarMatricula($dados);
            
            // Redireciona em caso de sucesso
            header('Location: index.php?status=success');
            exit;

        } catch (BusinessRuleException $e) {
            // Em caso de erro de regra de negócio, renderiza a view com a mensagem
            $erro = $e->getMessage();
            require_once 'view.php';
        } catch (Exception $e) {
            // Erro genérico
            $erro = "Ocorreu um erro inesperado. Tente novamente mais tarde.";
            require_once 'view.php';
        }
    }
}
