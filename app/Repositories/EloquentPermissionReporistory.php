<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;

class EloquentPermissionReporistory implements PermissionReporistoryInterface
{
    public function getAll()
    {
        $permissions = Permission::all();

        return $permissions;

    }

    public function FindById($id)
    {
        $permission = Permission::find($id);

        return $permission;
    }

    public function createPermission(array $atributes)
    {
        $permission = Permission::create($atributes);

        return $permission;
    }

    public function updatePermission($id, array $atributes)
    {
        $permission = Permission::find($id);
        $permission->update($atributes);

        return $permission;
    }

    public function deletePermission($id)
    {
        $permission = Permission::find($id);
        // dd($permission);
        $permission->delete();

        return true;
    }
}
