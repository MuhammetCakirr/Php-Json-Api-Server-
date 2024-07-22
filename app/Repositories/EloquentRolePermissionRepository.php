<?php

namespace App\Repositories;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EloquentRolePermissionRepository
{
    public function createRolePermission(array $atributes)
    {
        $role_id = $atributes['role_id'];
        $permission_id = $atributes['permission_id'];
        $role = Role::findOrFail($role_id);
        $permission = Permission::findOrFail($permission_id);

        $role->givePermissionTo($permission);
        $permission->assignRole($role);

        return $role;
    }

    public function deleteRolePermission(array $atributes)
    {
        $role_id = $atributes['role_id'];
        $permission_id = $atributes['permission_id'];
        $role = Role::findOrFail($role_id);
        $permission = Permission::findOrFail($permission_id);

        $role->revokePermissionTo($permission);

        return $role;
    }
}
