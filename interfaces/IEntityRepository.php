<?php

namespace Interfaces;

interface IEntityRepository {
    public function save($entity);
    public function find($id);
    public function findAll();
    public function delete($id);
}
