<?php

namespace App\Repositories;

interface AuthorRepositoryInterface
{
    public function getAllAuthor();

    public function findById($id);

    public function updateAuthor($id, array $attributes);

    public function createAuthor(array $attributes);

    public function deleteAuthor($id);
}
