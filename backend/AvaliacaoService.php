<?php

require_once 'IAvaliacaoRepository.php';
require_once 'BusinessRuleException.php';

class AvaliacaoService {
    private $repository;

    public function __construct(IAvaliacaoRepository $repository) {
        $this->repository = $repository;
    }

    public function registrarAvaliacao(array $dados): bool {
        // Validações de Regra de Negócio
        if (empty($dados['anime_id'])) {
            throw new BusinessRuleException("ID do anime é obrigatório.");
        }

        if (empty($dados['stars']) || $dados['stars'] < 1 || $dados['stars'] > 5) {
            throw new BusinessRuleException("Por favor, selecione uma nota de 1 a 5 estrelas.");
        }

        if (empty($dados['user_email']) || !filter_var($dados['user_email'], FILTER_VALIDATE_EMAIL)) {
            throw new BusinessRuleException("Um e-mail válido é obrigatório.");
        }

        $avaliacao = new Avaliacao();
        $avaliacao->anime_id = (int)$dados['anime_id'];
        $avaliacao->anime_name = $dados['anime_name'] ?? 'Anime Desconhecido';
        $avaliacao->user_email = $dados['user_email'];
        $avaliacao->stars = (int)$dados['stars'];
        $avaliacao->comment = $dados['comment'] ?? '';
        $avaliacao->created_at = date('Y-m-d H:i:s');

        return $this->repository->save($avaliacao);
    }

    public function listarRecentes(): array {
        return $this->repository->findAll();
    }
}
