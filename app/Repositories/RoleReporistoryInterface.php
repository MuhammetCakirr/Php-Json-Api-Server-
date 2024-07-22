<?php

namespace App\Repositories;

interface RoleReporistoryInterface
{
    public function getAll();

    public function FindById($id);

    public function createRole(array $atributes);

    public function updateRole($id, array $atributes);

    public function deleteRole($id);
}
