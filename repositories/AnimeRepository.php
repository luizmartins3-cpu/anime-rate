<?php

namespace Repositories;

use Interfaces\IEntityRepository;
use Core\Database;
use Models\Anime;
use PDO;

class AnimeRepository implements IEntityRepository {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function save($anime) {
        if ($anime->id) {
            $stmt = $this->db->prepare("UPDATE animes SET name = ?, image = ?, rating = ?, description = ?, full_description = ?, episodes = ?, seasons = ?, trailer = ? WHERE id = ?");
            $stmt->execute([$anime->name, $anime->image, $anime->rating, $anime->description, $anime->full_description, $anime->episodes, $anime->seasons, $anime->trailer, $anime->id]);
        } else {
            $stmt = $this->db->prepare("INSERT INTO animes (name, image, rating, description, full_description, episodes, seasons, trailer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$anime->name, $anime->image, $anime->rating, $anime->description, $anime->full_description, $anime->episodes, $anime->seasons, $anime->trailer]);
            $anime->id = $this->db->lastInsertId();
        }
        return $anime;
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM animes WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();
        return $data ? new Anime($data) : null;
    }

    public function findAll() {
        $stmt = $this->db->query("SELECT * FROM animes ORDER BY name ASC");
        $animes = [];
        while ($row = $stmt->fetch()) {
            $animes[] = new Anime($row);
        }
        return $animes;
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM animes WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function findByGenre($genre) {
        $stmt = $this->db->prepare("SELECT a.* FROM animes a JOIN anime_genres ag ON a.id = ag.anime_id JOIN genres g ON g.id = ag.genre_id WHERE g.name = ?");
        $stmt->execute([$genre]);
        $animes = [];
        while ($row = $stmt->fetch()) {
            $animes[] = new Anime($row);
        }
        return $animes;
    }
}
