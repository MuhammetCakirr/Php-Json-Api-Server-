<?php

namespace App\Repositories;

use App\Models\Status;

class EloquentStatusRepository implements StatusRepositoryInterface
{
    public function getAll()
    {
        return Status::get();
    }

    public function findById($id)
    {
        return Status::findOrFail($id);
    }

    public function create(array $attributes)
    {
        return Status::create($attributes);
    }

    public function update($id, array $attributes)
    {
        $status = Status::findOrFail($id);
        $status->update($attributes);

        return $status;
    }

    public function delete($id)
    {
        $status = Status::findOrFail($id);
        $status->delete();

        return true;
    }
}
