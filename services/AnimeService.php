<?php

namespace Services;

use Repositories\AnimeRepository;
use Core\BusinessRuleException;

class AnimeService {
    private $repository;

    public function __construct(AnimeRepository $repository) {
        $this->repository = $repository;
    }

    public function listAll() {
        return $this->repository->findAll();
    }

    public function getById($id) {
        if (!$id) throw new BusinessRuleException("ID do anime é obrigatório.");
        $anime = $this->repository->find($id);
        if (!$anime) throw new BusinessRuleException("Anime não encontrado.");
        return $anime;
    }

    public function create($data) {
        if (empty($data['name'])) throw new BusinessRuleException("O nome do anime é obrigatório.");
        $anime = new \Models\Anime($data);
        return $this->repository->save($anime);
    }
}
