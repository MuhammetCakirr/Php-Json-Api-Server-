<?php

namespace App\Services;

use App\Models\Book;
use App\Repositories\BookRepositoryInterface;

class BookService
{
    protected $repository;

    public function __construct(BookRepositoryInterface $bookRepositoryInterface)
    {
        $this->repository = $bookRepositoryInterface;
    }

    public function create($attributes)
    {
        $IsExistingBook = $this->isExistingBookName($attributes['title']);
        if ($IsExistingBook == false) {
            return $this->repository->createBook($attributes);
        } else {
            return '400';
        }
    }

    public function update($id, array $attributes)
    {
        $IsExistingBook = $this->isExistingBookId($id);
        if ($IsExistingBook == true) {
            return $this->repository->updateBook($id, $attributes);
        } else {
            return '400';
        }
    }

    public function delete($id)
    {
        if (Book::where('id', $id)->exists()) {
            return $this->repository->deleteBook($id);
        } else {
            return '400';
        }
    }

    public function isExistingBookId($id)
    {

        if (Book::where('id', $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    public function isExistingBookName($title)
    {

        if (Book::where('title', $title)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
