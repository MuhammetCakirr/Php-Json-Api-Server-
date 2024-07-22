<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $service;

    protected $repository;

    public function __construct(UserService $userService, UserRepositoryInterface $userRepositoryInterface)
    {
        $this->service = $userService;
        $this->repository = $userRepositoryInterface;
    }

    public function index()
    {
        $users = $this->repository->getAllUser();

        return response()->json($users);
    }

    public function show($id)
    {
        $user = $this->service->showbyId($id);
        if ($user == '400' || $user == null || empty($user)) {
            $data = [
                'status' => 400,
                'message' => 'There is no user belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'User was found successfully.',
                'data' => $user,
            ];
        }

        return response()->json($data);
    }

    public function create(UserCreateRequest $userCreateRequest)
    {
        $user = $this->service->create($userCreateRequest->validated());
        $data = [
            'status' => 200,
            'message' => 'User was successfully created.',
            'data' => $user,
        ];

        return response()->json($data);
    }

    public function update($id, UserUpdateRequest $userUpdateRequest)
    {
        $user = $this->service->update($id, $userUpdateRequest->validated());
        if ($user == '400' || $user == null || empty($user)) {
            $data = [
                'status' => 400,
                'message' => 'There is no user belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'User has been successfully updated.',
                'data' => $user,
            ];
        }

        return response()->json($data);
    }

    public function delete($id)
    {
        $user = $this->service->delete($id);
        if ($user == '400' || $user == null || empty($user)) {
            $data = [
                'status' => 400,
                'message' => 'There is no user belonging to this information.',
            ];
        } else {
            $data = [
                'status' => 200,
                'message' => 'User has been successfully deleted.',
            ];
        }

        return response()->json($data);
    }

    public function getUser(Request $request)
    {
        $user = $request->user();
        if ($user) {
            // Kullanıcının rollerini ve izinlerini al
            $roles = $user->getRoleNames();
            $permissions = $user->getAllPermissions();

            // Rolleri ve izinleri dd() ile görmek için
            dd($roles, $permissions);

            if (! $user->can($permission)) {
                return response()->json(['error' => 'Unauthorized'], 403);
            }
        } else {
            return response()->json(['error' => 'Unauthenticated'], 401);
        }
        //  return response()->json([
        //      'user' => $request->user()
        //      'roles'=>
        //  ]);
    }
}
