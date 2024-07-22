<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookUserCreateRequest;
use App\Http\Requests\BookUserUpdateRequest;
use App\Repositories\BookUserRepositoryInterface;
use App\Services\BookUserService;

class BookUserController extends Controller
{
    protected $service;

    protected $repository;

    public function __construct(BookUserService $bookUserService, BookUserRepositoryInterface $bookUserRepositoryInterface)
    {
        $this->service = $bookUserService;
        $this->repository = $bookUserRepositoryInterface;
    }

    public function index()
    {
        $bookusers = $this->repository->getAll();

        return response()->json($bookusers);
    }

    public function show($id)
    {
        $bookuser = $this->service->showById($id);
        if ($bookuser == '400' || $bookuser == null) {
            $data = [
                'status' => 400,
                'message' => 'There is no User-Book belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'User-Book was found successfully.',
                'data' => $bookuser,
            ];
        }

        return response()->json($data);
    }

    public function create(BookUserCreateRequest $bookusercreaterequest)
    {
        $createdvalue = $this->service->create($bookusercreaterequest->validated());
        $data = [
            'status' => 200,
            'message' => 'User-Book was successfully created.',
            'data' => $createdvalue,
        ];

        return response()->json($data);
    }

    public function update($id, BookUserUpdateRequest $bookUserUpdateRequest)
    {
        $updatedvalue = $this->service->update($id, $bookUserUpdateRequest->validated());
        if ($updatedvalue == '400' || $updatedvalue == null) {
            $data = [
                'status' => 400,
                'message' => 'There is no User-Book belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'User-Book has been successfully updated.',
                'data' => $updatedvalue,
            ];
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        $deletedvalue = $this->service->delete($id);

        if ($deletedvalue === true) {

            $data = [
                'status' => 200,
                'message' => 'User-Book was successfully deleted.',
            ];

        } else {
            $data = [
                'status' => 400,
                'message' => 'There is no User-book belonging to this information.',
            ];
        }

        return response()->json($data);
    }
}
