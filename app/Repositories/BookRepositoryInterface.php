<?php

namespace App\Repositories;

interface BookRepositoryInterface
{
    public function getAllBook();

    public function findById($id, $userId, $ipaddress);

    public function updateBook($id, array $attributes);

    public function createBook($attributes);

    public function deleteBook($id);
}
