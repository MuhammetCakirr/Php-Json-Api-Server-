<?php

namespace App\Repositories;

use App\Models\User;
use Spatie\Permission\Models\Role;

class EloquentRoleUserReporistory
{
    public function getAll()
    {
        $rolesAndUsers = Role::with('users')->get();

        return $rolesAndUsers;
    }

    public function create(array $atributes)
    {
        $roleId = $atributes['role_id'];
        $userId = $atributes['user_id'];

        $role = Role::findOrFail($roleId);

        $user = User::findOrFail($userId);
        $user->assignRole($role);

        return $user;
    }

    public function delete(array $atributes)
    {
        $roleId = $atributes['role_id'];
        $userId = $atributes['user_id'];

        $role = Role::findOrFail($roleId);

        $user = User::findOrFail($userId);

        $user->removeRole($role);

        return $user;
    }
}
