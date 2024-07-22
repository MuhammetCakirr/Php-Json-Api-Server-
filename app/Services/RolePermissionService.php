<?php

namespace App\Services;

use App\Repositories\RolePermissionReporistoryInterface;

class RolePermissionService
{
    protected $repo;

    public function __construct(RolePermissionReporistoryInterface $rolePermissionReporistoryInterface)
    {
        $this->repo = $rolePermissionReporistoryInterface;
    }

    public function create(array $atributes)
    {
        $roleperm = $this->repo->createRolePermission($atributes);

        return $roleperm;
    }

    public function delete(array $atributes)
    {
        $roleperm = $this->repo->deleteRolePermission($atributes);

        return $roleperm;
    }
}
