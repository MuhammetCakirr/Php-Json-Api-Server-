<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Repositories\EloquentAuthorRepository;
use App\Services\AuthorService;

class AuthorController extends Controller
{
    protected AuthorService $service;

    protected $repository;

    public function __construct(AuthorService $authorService, EloquentAuthorRepository $authorRepositoryInterface)
    {
        $this->service = $authorService;
        $this->repository = $authorRepositoryInterface;
    }

    public function index()
    {
        $authors = $this->repository->getAllAuthor();

        return response()->json($authors);
    }

    public function show($id)
    {
        $author = $this->service->show($id);
        if ($author == '400' || $author === null || empty($author)) {
            $data = [
                'status' => 400,
                'message' => 'There is no author belonging to this information.',

            ];

        } else {
            $data = [
                'status' => 200,
                'message' => 'Author was found successfully.',
                'data' => $author,
            ];
        }

        return response()->json($data);
    }

    public function create(AuthorRequest $authorRequest)
    {

        $newauthor = $this->service->create($authorRequest->validated());

        $data = [
            'status' => 200,
            'message' => 'Author was successfully created.',
            'data' => $newauthor,
        ];

        return response()->json($data);

    }

    public function update($id, AuthorRequest $authorRequest)
    {
        $updatedauthor = $this->service->update($id, $authorRequest->validated());

        if ($updatedauthor == null || $updatedauthor == '400' || empty($updatedauthor)) {
            $data = [
                'status' => 400,
                'message' => 'There is no author belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Author has been successfully updated.',
                'data' => $updatedauthor,
            ];
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        $deletedauthor = $this->service->delete($id);
        if ($deletedauthor == null || $deletedauthor == '400' || empty($deletedauthor)) {
            $data = [
                'status' => 400,
                'message' => 'There is no author belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Author was successfully deleted.',

            ];
        }

        return response()->json($data);
    }
}
