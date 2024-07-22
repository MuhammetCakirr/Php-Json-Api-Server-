<?php

namespace App\Services;

use App\Repositories\StatusRepositoryInterface;

class StatusService
{
    /**
     * Create a new class instance.
     */
    protected $statusRepository;

    public function __construct(StatusRepositoryInterface $statusRepository)
    {
        $this->statusRepository = $statusRepository;
    }

    public function createStatus(array $data)
    {

        return $this->statusRepository->create($data);
    }

    public function updateStatus($id, array $data)
    {

        return $this->statusRepository->update($id, $data);
    }

    public function getStatusById($id)
    {
        return $this->statusRepository->findById($id);
    }
}
