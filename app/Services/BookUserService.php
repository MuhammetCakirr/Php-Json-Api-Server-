<?php

namespace App\Services;

use App\Models\UserBook;
use App\Repositories\BookUserRepositoryInterface;

class BookUserService
{
    protected $repo;

    public function __construct(BookUserRepositoryInterface $bookUserRepositoryInterface)
    {
        $this->repo = $bookUserRepositoryInterface;
    }

    public function showById($id)
    {
        $isexist = $this->IsExistingUserBook($id);
        if ($isexist == true) {
            return $this->repo->findByIdBookUser($id);
        } else {
            return '400';
        }
    }

    public function create(array $attributes)
    {
        return $this->repo->createBookUser($attributes);
    }

    public function update($id, array $attributes)
    {
        $isexist = $this->IsExistingUserBook($id);

        if ($isexist == true) {
            return $this->repo->updateBookUser($id, $attributes);
        } else {
            return '400';
        }
    }

    public function delete($id)
    {
        $isexist = $this->IsExistingUserBook($id);

        if ($isexist === true) {

            $isdone = $this->repo->deleteBookUser($id);

            return $isdone;
        } else {
            return '400';
        }
    }

    private function IsExistingUserBook($id)
    {
        if (UserBook::where('id', $id)->exists()) {
            return true;
        } else {
            return false;
        }
    }
}
