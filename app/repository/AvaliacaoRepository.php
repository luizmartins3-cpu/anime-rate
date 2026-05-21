<?php

namespace Repositories;

use Interfaces\IAvaliacaoRepository;
use Models\Avaliacao;
use PDO;

class AvaliacaoRepository implements IAvaliacaoRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save($avaliacao): bool {
        $stmt = $this->db->prepare("
            INSERT INTO avaliacoes (anime_id, anime_name, user_email, stars, comment, created_at)
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        
        return $stmt->execute([
            $avaliacao->anime_id,
            $avaliacao->anime_name,
            $avaliacao->user_email,
            $avaliacao->stars,
            $avaliacao->comment,
            $avaliacao->created_at
        ]);
    }

    public function findAll(): array {
        $stmt = $this->db->query("SELECT * FROM avaliacoes ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_CLASS, Avaliacao::class);
    }
}
