<?php

namespace Controllers;

use Services\AvaliacaoService;
use Core\BusinessRuleException;
use Exception;

class AvaliacaoController {
    private $service;

    public function __construct(AvaliacaoService $service) {
        $this->service = $service;
    }

    public function index() {
        $avaliacoes = $this->service->listarRecentes();
        require __DIR__ . '/../views/view_feedback.php';
    }

    public function store() {
        try {
            // Dados vindos do POST
            $dados = [
                'anime_id'   => $_POST['anime_id'] ?? null,
                'anime_name' => $_POST['anime_name'] ?? null,
                'user_email' => $_POST['email'] ?? null,
                'stars'      => $_POST['stars'] ?? null,
                'comment'    => $_POST['comment'] ?? null
            ];

            $this->service->registrarAvaliacao($dados);
            
            // Sucesso -> Redireciona com flag
            header('Location: index.php?action=list&status=success');
            exit;

        } catch (BusinessRuleException $e) {
            $erro = $e->getMessage();
            $avaliacoes = $this->service->listarRecentes(); // Recarrega para a view
            require __DIR__ . '/../views/view_feedback.php';
        } catch (Exception $e) {
            $erro = "Ops! Algo deu errado no servidor. Tente novamente.";
            $avaliacoes = $this->service->listarRecentes();
            require __DIR__ . '/../views/view_feedback.php';
        }
    }
}
