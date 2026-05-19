<?php

require_once 'IMatriculaRepository.php';
require_once 'Matricula.php';

class MatriculaRepository implements IMatriculaRepository {
    private $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    public function save(Matricula $matricula): bool {
        $sql = "INSERT INTO matriculas (nome, idade, curso, data) VALUES (:nome, :idade, :curso, :data)";
        $stmt = $this->db->prepare($sql);
        
        return $stmt->execute([
            ':nome'  => $matricula->nome,
            ':idade' => $matricula->idade,
            ':curso' => $matricula->curso,
            ':data'  => $matricula->data
        ]);
    }

    public function find(int $id): ?Matricula {
        $sql = "SELECT * FROM matriculas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        
        $row = $stmt->fetch();
        if (!$row) return null;

        $matricula = new Matricula();
        $matricula->id = $row['id'];
        $matricula->nome = $row['nome'];
        $matricula->idade = $row['idade'];
        $matricula->curso = $row['curso'];
        $matricula->data = $row['data'];

        return $matricula;
    }

    public function delete(int $id): bool {
        $sql = "DELETE FROM matriculas WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

    public function findAll(): array {
        $sql = "SELECT * FROM matriculas";
        $stmt = $this->db->query($sql);
        $rows = $stmt->fetchAll();
        
        $matriculas = [];
        foreach ($rows as $row) {
            $m = new Matricula();
            $m->id = $row['id'];
            $m->nome = $row['nome'];
            $m->idade = $row['idade'];
            $m->curso = $row['curso'];
            $m->data = $row['data'];
            $matriculas[] = $m;
        }
        return $matriculas;
    }
}
