<?php

namespace App\Services;

use App\Repositories\PermissionReporistoryInterface;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    protected $repo;

    public function __construct(PermissionReporistoryInterface $permissionReporistoryInterface)
    {
        $this->repo = $permissionReporistoryInterface;
    }

    public function create(array $atributes)
    {
        $isexist = $this->isExistPermissionName($atributes['name']);
        if ($isexist === false) {
            $permission = $this->repo->createPermission($atributes);

            return $permission;
        } else {
            return '400';
        }
    }

    public function update($id, array $atributes)
    {
        $isexist = $this->isExistPermission($id);
        if ($isexist === true) {
            $permission = $this->repo->updatePermission($id, $atributes);

            return $permission;
        } else {
            return '400';
        }
    }

    public function delete($id)
    {
        $isexist = $this->isExistPermission($id);
        if ($isexist === true) {
            $permission = $this->repo->deletePermission($id);

            return $permission;
        } else {
            return '400';
        }
    }

    public function show($id)
    {
        $isexist = $this->isExistPermission($id);
        if ($isexist === true) {
            $permission = $this->repo->FindById($id);

            return $permission;
        } else {
            return '400';
        }
    }

    private function isExistPermission($id)
    {
        if (Permission::where('id', $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    private function isExistPermissionName($name)
    {

        if (Permission::where('name', $name)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
