<?php

namespace App\Repositories;

use App\Models\User;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function getAllUser()
    {
        $users = User::with(['userBooks.book', 'userBooks.status'])->get();

        return $users;
    }

    public function findById($id)
    {
        $user = User::where('id', $id)->with(['userBooks.book', 'userBooks.status'])->firstOrFail();

        return $user;
    }

    public function createUser(array $attiributes)
    {
        $user = User::create($attiributes);

        return $user;
    }

    public function updateUser($id, array $attiributes)
    {
        $user = User::findOrFail($id);
        $user->update($attiributes);

        return $user;
    }

    public function deleteUser($id)
    {
        User::where('id', $id)->delete();

        return true;
    }
}
