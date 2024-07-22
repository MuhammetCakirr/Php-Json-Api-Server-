<?php

namespace App\Services;

use App\Models\Author;
use App\Repositories\AuthorRepositoryInterface;

class AuthorService
{
    protected $repository;

    public function __construct(AuthorRepositoryInterface $authorRepositoryInterface)
    {
        $this->repository = $authorRepositoryInterface;
    }

    public function create(array $attributes)
    {
        return $this->repository->createAuthor($attributes);
    }

    public function update($id, array $attributes)
    {
        $IsExistingAuthor = $this->isExistingAuthorId($id);
        if ($IsExistingAuthor == true) {
            return $this->repository->updateAuthor($id, $attributes);
        } else {
            return '400';
        }
    }

    public function delete($id)
    {
        $IsExistingAuthor = $this->isExistingAuthorId($id);
        if ($IsExistingAuthor == true) {
            return $this->repository->deleteAuthor($id);
        } else {
            return '400';
        }
    }

    public function show($id)
    {
        $IsExistingAuthor = $this->isExistingAuthorId($id);
        if ($IsExistingAuthor == true) {
            return $this->repository->findById($id);
        } else {
            return '400';
        }
    }

    public function isExistingAuthorId($id)
    {

        if (Author::where('id', $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
