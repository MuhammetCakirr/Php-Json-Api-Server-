<?php

namespace App\Repositories;

use App\Models\Genre;

class EloquentGenreRepository implements GenreRepositoryInterface
{
    public function getAll()
    {
        return Genre::all();
    }

    public function findById($id)
    {
        return Genre::where('id', $id)->firstOrFail();
    }

    public function create(array $attributes)
    {
        if (Genre::where('name', $attributes['name'])->exists()) {
            return null;
        }

        return Genre::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $data = Genre::findOrFail($id);
        $data->update($attributes);

        return $data;
    }

    public function delete($id)
    {
        Genre::where('id', $id)->delete();

        return true;

    }
}
