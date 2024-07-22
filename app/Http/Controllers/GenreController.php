<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenreRequest;
use App\Repositories\GenreRepositoryInterface;
use App\Services\GenreService;

class GenreController extends Controller
{
    protected $service;

    protected $repo;

    public function __construct(GenreService $genreService, GenreRepositoryInterface $genreRepository)
    {
        $this->service = $genreService;
        $this->repo = $genreRepository;
    }

    public function index()
    {
        $genres = $this->repo->getAll();

        return response()->json($genres);
    }

    public function show($id)
    {
        $genres = $this->repo->findById($id);

        return response()->json($genres);
    }

    public function create(GenreRequest $genreRequest)
    {
        $genre = $this->service->createGenre($genreRequest->validated());
        if (empty($genre) || $genre == null) {
            $data = [
                'status' => 400,
                'message' => 'There is already a genre with such a name.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Genre was successfully created.',
                'data' => $genre,
            ];
        }

        return response()->json($data);
    }

    public function update($id, GenreRequest $genreRequest)
    {

        $returndata = $this->service->updateGenre($id, $genreRequest->validated());
        if ($returndata == '400') {
            $data = [
                'status' => 400,
                'message' => 'There is no genre belonging to this information.',

            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Genre has been successfully updated.',
                'data' => $returndata,
            ];
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        $returneddata = $this->service->deleteGenre($id);
        if ($returneddata == '400') {
            $data = [
                'status' => 400,
                'message' => 'There is no such genre.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Genre was successfully deleted.',
            ];
        }

        return response()->json($data);
    }
}
