<?php

namespace App\Repositories;

use Spatie\Permission\Models\Role;

class EloquentRoleReporistory implements RoleReporistoryInterface
{
    public function getAll()
    {
        $roles = Role::with('permissions')->get();

        return $roles;
    }

    public function FindById($id)
    {
        $role = Role::find($id);

        return $role;
    }

    public function createRole(array $atributes)
    {
        $role = Role::create($atributes);

        return $role;
    }

    public function updateRole($id, array $atributes)
    {
        $role = Role::find($id);
        $role->update($atributes);

        return $role;
    }

    public function deleteRole($id)
    {
        $role = Role::find($id);
        $role->delete();

        return true;
    }
}
