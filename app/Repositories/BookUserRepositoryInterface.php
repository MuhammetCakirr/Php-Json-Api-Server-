<?php

namespace App\Repositories;

interface BookUserRepositoryInterface
{
    public function getAll();

    public function findByIdBookUser($id);

    public function createBookUser(array $attributes);

    public function updateBookUser($id, array $attributes);

    public function deleteBookUser($id);
}
