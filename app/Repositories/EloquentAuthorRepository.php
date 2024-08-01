<?php

namespace App\Repositories;

use App\Models\Author;
use Illuminate\Support\Collection;

class EloquentAuthorRepository implements AuthorRepositoryInterface
{
    /**
     * Returns all athors with books
     *
     * @return Collection<int, Author>
     */
    public function getAllAuthor(): Collection
    {
        return Author::with('books')->get();
    }

    public function findById($id)
    {
        return Author::query()->where('id', $id)->with('books')->firstOrFail();
    }

    public function updateAuthor($id, array $attributes)
    {
        $author = Author::query()->findOrFail($id);

        $author->update($attributes);

        return $author;
    }

    public function createAuthor(array $attributes)
    {
        return Author::create($attributes);
    }

    public function deleteAuthor($id)
    {
        Author::where('id', $id)->delete();

        return true;
    }
}
