<?php

namespace App\Repositories;

use App\Models\UserBook;

class EloquentBookUserRepository implements BookUserRepositoryInterface
{
    public function getAll()
    {
        return UserBook::with('user', 'book', 'status')->get();
    }

    public function findByIdBookUser($id)
    {
        $bookuser = UserBook::with('user', 'book', 'status')->findOrFail($id);

        return $bookuser;
    }

    public function createBookUser(array $attributes)
    {
        return UserBook::create($attributes);
    }

    public function updateBookUser($id, array $attributes)
    {
        $bookuser = UserBook::find($id);
        $updateData = [];

        if (isset($attributes['user_id'])) {
            $updateData['user_id'] = $attributes['user_id'];
        }
        if (isset($attributes['book_id'])) {
            $updateData['book_id'] = $attributes['book_id'];
        }
        if (isset($attributes['status_id'])) {
            $updateData['status_id'] = $attributes['status_id'];
        }
        if (isset($attributes['dateofdelivery'])) {
            $updateData['dateofdelivery'] = $attributes['dateofdelivery'];
        }
        if (! empty($updateData)) {
            $bookuser->update($updateData);
        }

        return $bookuser;
    }

    public function deleteBookUser($id)
    {
        $bookuser = UserBook::find($id);
        $bookuser->delete();

        return true;
    }
}
