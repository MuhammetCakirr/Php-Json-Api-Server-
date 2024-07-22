<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
    public function getAllUser();

    public function findById($id);

    public function createUser(array $attiributes);

    public function updateUser($id, array $attiributes);

    public function deleteUser($id);
}
