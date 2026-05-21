<?php

namespace Interfaces;

interface IAvaliacaoRepository {
    public function save($avaliacao): bool;
    public function findAll(): array;
}
