<?php

interface IMatriculaRepository {
    public function save(Matricula $matricula): bool;
    public function find(int $id): ?Matricula;
    public function delete(int $id): bool;
    public function findAll(): array;
}
