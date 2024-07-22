<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleUserRequest;
use App\Repositories\EloquentRoleUserReporistory;
use App\Services\RoleUserService;

class RoleUserController extends Controller
{
    protected $service;

    protected $repo;

    public function __construct(EloquentRoleUserReporistory $eloquentRoleUserReporistory, RoleUserService $roleUserService)
    {
        $this->service = $roleUserService;
        $this->repo = $eloquentRoleUserReporistory;
    }

    public function create(RoleUserRequest $roleUserRequest)
    {
        $roleuser = $this->service->create($roleUserRequest->validated());
        $data = [
            'status' => 200,
            'message' => 'The role was successfully added to the user.',
            'data' => $roleuser,
        ];

        return response()->json($data);
    }

    public function delete(RoleUserRequest $roleUserRequest)
    {
        $roleuser = $this->service->delete($roleUserRequest->validated());
        $data = [
            'status' => 200,
            'message' => 'The role was successfully removed from the user.',
        ];

        return response()->json($data);
    }

    public function index()
    {
        $roleandusers = $this->repo->getAll();

        return response()->json($roleandusers);
    }
}
