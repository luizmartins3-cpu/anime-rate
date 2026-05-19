<?php

interface IAvaliacaoRepository {
    public function save(Avaliacao $avaliacao): bool;
    public function find(int $id): ?Avaliacao;
    public function findAll(): array;
}
