<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolePermissionCreateRequest;
use App\Repositories\EloquentRolePermissionRepository;

class RolePermissionController extends Controller
{
    protected $service;

    public function __construct(EloquentRolePermissionRepository $eloquentRolePermissionRepository)
    {
        $this->service = $eloquentRolePermissionRepository;
    }

    public function create(RolePermissionCreateRequest $rolePermissionCreateRequest)
    {
        $roleperm = $this->service->createRolePermission($rolePermissionCreateRequest->validated());
        $data = [
            'status' => 200,
            'message' => 'Permission to the role was successfully added.',
            'data' => $roleperm,
        ];

        return response()->json($data);
    }

    public function delete(RolePermissionCreateRequest $rolePermissionCreateRequest)
    {
        $roleperm = $this->service->deleteRolePermission($rolePermissionCreateRequest->validated());
        $data = [
            'status' => 200,
            'message' => 'Permission from the role was successfully deleted.',
            'data' => $roleperm,
        ];

        return response()->json($data);
    }
}
