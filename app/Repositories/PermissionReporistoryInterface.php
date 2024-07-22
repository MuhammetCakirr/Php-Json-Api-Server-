<?php

namespace App\Repositories;

interface PermissionReporistoryInterface
{
    public function getAll();

    public function FindById($id);

    public function createPermission(array $atributes);

    public function updatePermission($id, array $atributes);

    public function deletePermission($id);
}
