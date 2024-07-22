<?php

namespace App\Repositories;

interface RolePermissionReporistoryInterface
{
    // public function getAll();
    // public function FindById($id);
    public function createRolePermission(array $atributes);

    public function updateRolePermission($id, array $atributes);

    public function deleteRolePermission($id);
}
