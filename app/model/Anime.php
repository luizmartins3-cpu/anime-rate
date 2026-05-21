<?php

namespace Models;

class Anime {
    public $id;
    public $name;
    public $image;
    public $rating;
    public $description;
    public $full_description;
    public $episodes;
    public $seasons;
    public $trailer;
    public $genres = [];

    public function __construct($data = []) {
        $this->id = $data['id'] ?? null;
        $this->name = $data['name'] ?? null;
        $this->image = $data['image'] ?? null;
        $this->rating = $data['rating'] ?? null;
        $this->description = $data['description'] ?? null;
        $this->full_description = $data['full_description'] ?? null;
        $this->episodes = $data['episodes'] ?? null;
        $this->seasons = $data['seasons'] ?? null;
        $this->trailer = $data['trailer'] ?? null;
        $this->genres = $data['genres'] ?? [];
    }
}
