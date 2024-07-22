<?php

namespace App\Http\Controllers;

use App\Http\Requests\StatusRequest;
use App\Repositories\StatusRepositoryInterface;
use App\Services\StatusService;

class StatusController extends Controller
{
    protected $statusService;

    protected $statusRepository;

    public function __construct(StatusService $statusService, StatusRepositoryInterface $statusRepository)
    {
        $this->statusService = $statusService;
        $this->statusRepository = $statusRepository;
    }

    public function index()
    {
        $statuses = $this->statusRepository->getAll();

        return response()->json($statuses);
    }

    public function store(StatusRequest $request)
    {
        $status = $this->statusService->createStatus($request->validated());

        $data = [
            'data' => $status,
            'status' => 200,
            'message' => 'Status was successfully created.',
        ];

        return response()->json($data);
    }

    public function show($id)
    {
        $status = $this->statusRepository->findById($id);

        return response()->json($status);
    }

    public function update(StatusRequest $request, $id)
    {
        $status = $this->statusService->updateStatus($id, $request->validated());
        $data = [
            'data' => $status,
            'status' => 200,
            'message' => 'Status has been successfully updated.',
        ];

        return response()->json($data);
    }

    public function destroy($id)
    {
        $this->statusRepository->delete($id);

        return response()->json(['message' => 'Status deleted successfully.']);
    }
}
