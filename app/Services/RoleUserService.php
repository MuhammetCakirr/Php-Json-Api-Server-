<?php

namespace App\Services;

use App\Repositories\EloquentRoleUserReporistory;

class RoleUserService
{
    protected $repo;

    public function __construct(EloquentRoleUserReporistory $eloquentRoleUserReporistory)
    {
        $this->repo = $eloquentRoleUserReporistory;
    }

    public function create(array $atributes)
    {
        $roleuser = $this->repo->create($atributes);

        return $roleuser;
    }

    public function delete(array $atributes)
    {
        $roleanduser = $this->repo->delete($atributes);

        return $roleanduser;
    }
}
