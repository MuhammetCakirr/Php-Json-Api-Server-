<?php

namespace App\Repositories;

use App\Models\Author;

class EloquentAuthorRepository implements AuthorRepositoryInterface
{
    public function getAllAuthor()
    {
        return Author::with('books')->get();
    }

    public function findById($id)
    {
        return Author::where('id', $id)->with('books')->firstOrFail();
    }

    public function updateAuthor($id, array $attributes)
    {
        $author = Author::findOrFail($id);
        $author->update($attributes);

        return $author;
    }

    public function createAuthor(array $attributes)
    {
        $author = Author::create($attributes);

        return $author;
    }

    public function deleteAuthor($id)
    {
        Author::where('id', $id)->delete();

        return true;
    }
}
