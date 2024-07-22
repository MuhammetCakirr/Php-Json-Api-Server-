<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionCreateRequest;
use App\Repositories\PermissionReporistoryInterface;
use App\Services\PermissionService;

class PermissionController extends Controller
{
    protected $service;

    protected $repo;

    public function __construct(PermissionReporistoryInterface $roleReporistoryInterface, PermissionService $roleService)
    {
        $this->service = $roleService;
        $this->repo = $roleReporistoryInterface;
    }

    public function create(PermissionCreateRequest $permissionCreateRequest)
    {
        $perm = $this->service->create($permissionCreateRequest->validated());
        if ($perm === null || $perm === '400' || empty($perm)) {
            $data = [
                'status' => 400,
                'message' => 'There is no permission belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Permission has been successfully created.',
                'data' => $perm,
            ];
        }

        return response()->json($data);
    }

    public function update($id, PermissionCreateRequest $roleCreateRequest)
    {
        $perm = $this->service->update($id, $roleCreateRequest->validated());
        if ($perm === null || $perm === '400' || empty($perm)) {
            $data = [
                'status' => 400,
                'message' => 'There is no permission belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Permission has been successfully updated.',
                'data' => $perm,
            ];
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        $perm = $this->service->delete($id);

        if ($perm === null || $perm === '400' || empty($perm)) {
            $data = [
                'status' => 400,
                'message' => 'There is no permission belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Permission was successfully deleted.',
            ];
        }

        return response()->json($data);
    }

    public function index()
    {
        $permissions = $this->repo->getAll();

        return response()->json($permissions);
    }

    public function show($id)
    {
        $perm = $this->service->show($id);
        if ($perm === null || $perm === '400') {
            $data = [
                'status' => 400,
                'message' => 'There is no permission belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'Permission was found successfully.',
                'data' => $perm,
            ];
        }

        return response()->json($data);
    }
}
