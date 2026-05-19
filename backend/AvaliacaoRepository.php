<?php

require_once 'IAvaliacaoRepository.php';
require_once 'Avaliacao.php';

class AvaliacaoRepository implements IAvaliacaoRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save(Avaliacao $avaliacao): bool {
        $sql = "INSERT INTO avaliacoes (anime_id, anime_name, user_email, stars, comment, created_at) 
                VALUES (:anime_id, :anime_name, :user_email, :stars, :comment, :created_at)";
        
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':anime_id'   => $avaliacao->anime_id,
            ':anime_name' => $avaliacao->anime_name,
            ':user_email' => $avaliacao->user_email,
            ':stars'      => $avaliacao->stars,
            ':comment'    => $avaliacao->comment,
            ':created_at' => $avaliacao->created_at ?: date('Y-m-d H:i:s')
        ]);
    }

    public function find(int $id): ?Avaliacao {
        $sql = "SELECT * FROM avaliacoes WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $row = $stmt->fetch();
        if (!$row) return null;

        $avaliacao = new Avaliacao();
        $avaliacao->id = $row['id'];
        $avaliacao->anime_id = $row['anime_id'];
        $avaliacao->anime_name = $row['anime_name'];
        $avaliacao->user_email = $row['user_email'];
        $avaliacao->stars = $row['stars'];
        $avaliacao->comment = $row['comment'];
        $avaliacao->created_at = $row['created_at'];

        return $avaliacao;
    }

    public function findAll(): array {
        $sql = "SELECT * FROM avaliacoes ORDER BY created_at DESC";
        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll();
        
        $avaliacoes = [];
        foreach ($rows as $row) {
            $a = new Avaliacao();
            $a->id = $row['id'];
            $a->anime_id = $row['anime_id'];
            $a->anime_name = $row['anime_name'];
            $a->user_email = $row['user_email'];
            $a->stars = $row['stars'];
            $a->comment = $row['comment'];
            $a->created_at = $row['created_at'];
            $avaliacoes[] = $a;
        }
        return $avaliacoes;
    }
}
