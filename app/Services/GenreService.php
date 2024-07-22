<?php

namespace App\Services;

use App\Models\Genre;
use App\Repositories\GenreRepositoryInterface;

class GenreService
{
    protected $genreRepository;

    public function __construct(GenreRepositoryInterface $genreRepository)
    {
        $this->genreRepository = $genreRepository;
    }

    public function createGenre(array $data)
    {
        return $this->genreRepository->create($data);

    }

    public function updateGenre($id, array $data)
    {
        $isexists = $this->isExistGenre($id);
        if ($isexists == true) {
            return $this->genreRepository->update($id, $data);
        } else {
            return '400';
        }

    }

    public function deleteGenre($id)
    {
        $isexists = $this->isExistGenre($id);
        if ($isexists == true) {
            return $this->genreRepository->delete($id);
        } else {
            return '400';
        }

    }

    public function isExistGenre($id)
    {
        if (Genre::where('id', $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
