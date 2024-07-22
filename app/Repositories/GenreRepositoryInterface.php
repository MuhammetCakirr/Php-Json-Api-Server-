<?php

namespace App\Repositories;

interface GenreRepositoryInterface
{
    public function getAll();

    public function findById($id);

    public function create(array $attributes);

    public function update($id, array $attributes);

    public function delete($id);
}
