<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class UserService
{
    protected $repository;

    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->repository = $userRepositoryInterface;
    }

    public function create(array $attiributes)
    {
        $attiributes['password'] = $this->hashPassword($attiributes['password']);

        return $this->repository->createUser($attiributes);
    }

    public function update($id, array $attiributes)
    {
        $isexisting = $this->isExistUser($id);

        if ($isexisting == true) {
            if (array_key_exists('password', $attiributes)) {
                $attiributes['password'] = $this->hashPassword($attiributes['password']);
            }

            return $this->repository->updateUser($id, $attiributes);
        } else {
            return '400';
        }
    }

    public function delete($id)
    {
        $isexisting = $this->isExistUser($id);
        if ($isexisting == true) {
            $this->repository->deleteUser($id);

            return '200';

        } else {
            return '400';
        }
    }

    public function showbyId($id)
    {
        $isexisting = $this->isExistUser($id);
        if ($isexisting == true) {

            $user = $this->repository->findById($id);

            return $user;
        } else {
            dd('user yok');

            return '400';
        }
    }

    public function isExistUser($id)
    {
        if (User::where('id', $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }

    private function hashPassword($password)
    {
        return Hash::make($password);
    }
}

// $2y$12$6SH0ZMpfVh7b0KaMlMf9G.P1gbiAdI8mhMPN3AgsDl3bjkwmOI0pm
// "$2y$12$Ch90AzoMqqFwQ2Kt27ROduBce7Vbc6gHFsM0HkGENEKKOl3QiOyZq"
