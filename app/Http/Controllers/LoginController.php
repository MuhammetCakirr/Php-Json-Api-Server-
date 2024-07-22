<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\FailedLogin;
use App\Models\LoginLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(UserLoginRequest $userLoginRequest)
    {

        $email = $userLoginRequest->email;
        $password = $userLoginRequest->password;

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $user = Auth::user();
            $token = $user->createToken('token-name')->plainTextToken;

            LoginLog::create([
                'user_id' => $user->id,
                'ip_address' => $userLoginRequest->ip(),
                'login_at' => now(),
            ]);
            FailedLogin::create([
                'email' => $email,
                'ip_address' => $userLoginRequest->ip(),
                'attempted_at' => now(),
                'status' => 'successful',
            ]);
            $data = [
                'status' => 200,
                'message' => 'Login was made successfully.',
                'token' => $token,
            ];
        } else {
            FailedLogin::create([
                'email' => $email,
                'ip_address' => $userLoginRequest->ip(),
                'attempted_at' => now(),
                'status' => 'unsuccessful',
            ]);
            $data = [
                'status' => 400,
                'message' => 'User for this information could not be found.The wrong password or email.',

            ];
        }

        return response()->json($data);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $loginLog = LoginLog::where('user_id', $user->id)
            ->whereNull('logout_at')
            ->latest()
            ->first();

        if ($loginLog) {
            $loginLog->update([
                'logout_at' => now(),
            ]);
        }
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();

        return response()->json([
            'message' => 'Logout successful.',
        ]);
    }
}
