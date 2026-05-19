<?php

require_once 'IMatriculaRepository.php';
require_once 'BusinessRuleException.php';

class MatriculaService {
    private $repository;

    public function __construct(IMatriculaRepository $repository) {
        $this->repository = $repository;
    }

    public function salvarMatricula(array $dados): bool {
        // Validação básica
        if (empty($dados['nome'])) {
            throw new BusinessRuleException("O nome é obrigatório.");
        }

        if (empty($dados['idade']) || $dados['idade'] < 0) {
            throw new BusinessRuleException("A idade deve ser um número válido.");
        }

        if (empty($dados['curso'])) {
            throw new BusinessRuleException("O curso deve ser selecionado.");
        }

        $matricula = new Matricula();
        $matricula->nome = $dados['nome'];
        $matricula->idade = $dados['idade'];
        $matricula->curso = $dados['curso'];
        $matricula->data = date('Y-m-d H:i:s');

        return $this->repository->save($matricula);
    }

    public function listarTodas(): array {
        return $this->repository->findAll();
    }
}
