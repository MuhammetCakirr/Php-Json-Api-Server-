<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\RoleReporistoryInterface;
use Spatie\Permission\Models\Role;

class RoleService
{
    protected $repo;

    public function __construct(RoleReporistoryInterface $roleReporistoryInterface)
    {
        $this->repo = $roleReporistoryInterface;
    }

    public function create(array $atributes)
    {
        $isExisting = $this->isExistRoleName($atributes['name']);

        if ($isExisting === false) {
            $createdrole = $this->repo->createRole($atributes);

            return $createdrole;
        } else {

            return '400';
        }
    }

    public function update($id, array $atributes)
    {
        $isExisting = $this->isExistRole($id);
        if ($isExisting === true) {
            $updatedrole = $this->repo->updateRole($id, $atributes);

            return $updatedrole;
        } else {
            return '400';
        }
    }

    public function delete($id)
    {
        $isExisting = $this->isExistRole($id);
        if ($isExisting === true) {
            $isused = $this->isItUsed($id);
            if ($isused == true) {
                return '500';
            } else {
                $isdone = $this->repo->deleteRole($id);

                return $isdone;
            }

        } else {
            return '400';
        }
    }

    public function show($id)
    {
        $isExisting = $this->isExistRole($id);
        if ($isExisting === true) {
            $role = $this->repo->FindById($id);

            return $role;
        } else {
            return '400';
        }

    }

    private function isExistRole($id)
    {
        if (Role::where('id', $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    private function isExistRoleName($name)
    {

        if (Role::where('name', $name)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    private function isItUsed($id)
    {
        $role = Role::findOrFail($id);
        $usersWithRole = User::role($role->name)->count();

        if ($usersWithRole > 0) {
            return true;
        } else {
            return false;
        }
    }
}
