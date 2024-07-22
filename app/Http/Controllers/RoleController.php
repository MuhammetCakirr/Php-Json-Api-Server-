<?php

namespace App\Http\Controllers;

use App\Http\Requests\RoleCreateRequest;
use App\Repositories\RoleReporistoryInterface;
use App\Services\RoleService;

class RoleController extends Controller
{
    protected $service;

    protected $repo;

    public function __construct(RoleReporistoryInterface $roleReporistoryInterface, RoleService $roleService)
    {
        $this->service = $roleService;
        $this->repo = $roleReporistoryInterface;

    }

    public function create(RoleCreateRequest $roleCreateRequest)
    {
        $role = $this->service->create($roleCreateRequest->validated());
        if ($role == null || $role == '400' || empty($role)) {
            $data = [
                'status' => 400,
                'message' => 'There is no role belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Role has been successfully created.',
                'data' => $role,
            ];
        }

        return response()->json($data);
    }

    public function update($id, RoleCreateRequest $roleCreateRequest)
    {
        $role = $this->service->update($id, $roleCreateRequest->validated());
        if ($role == null || $role == '400' || empty($role)) {
            $data = [
                'status' => 400,
                'message' => 'There is no role belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Role has been successfully updated.',
                'data' => $role,
            ];
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        $role = $this->service->delete($id);
        if ($role == null || $role == '400' || empty($role)) {
            $data = [
                'status' => 400,
                'message' => 'There is no role belonging to this information.',
            ];
        } elseif ($role == '500') {
            $data = [
                'status' => 500,
                'message' => 'This role is assigned to some users and cannot be deleted.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Role was successfully deleted.',
            ];
        }

        return response()->json($data);
    }

    public function index()
    {
        $roles = $this->repo->getAll();

        return response()->json($roles);
    }

    public function show($id)
    {
        $role = $this->service->show($id);
        if ($role === null || $role === '400') {
            $data = [
                'status' => 400,
                'message' => 'There is no role belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Role was found successfully.',
                'data' => $role,
            ];
        }

        return response()->json($data);
    }
}
