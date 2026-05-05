<?php

namespace Controllers;

use Services\AnimeService;
use Core\BusinessRuleException;

class AnimeController {
    private $service;

    public function __construct(AnimeService $service) {
        $this->service = $service;
    }

    public function index() {
        try {
            $animes = $this->service->listAll();
            require __DIR__ . '/../views/home.php';
        } catch (BusinessRuleException $e) {
            $error = $e->getMessage();
            require __DIR__ . '/../views/error.php';
        }
    }

    public function details($id) {
        try {
            $anime = $this->service->getById($id);
            require __DIR__ . '/../views/details.php';
        } catch (BusinessRuleException $e) {
            $error = $e->getMessage();
            require __DIR__ . '/../views/error.php';
        }
    }
}
