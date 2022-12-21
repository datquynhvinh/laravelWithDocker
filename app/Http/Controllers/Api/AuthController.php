<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class AuthController extends Controller
{
    use HasApiTokens;

    public function login(Request $request)
    {
        $checkLogin =  Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);
        $token = null;

        if ($checkLogin) {
            $authUser = Auth::user();
            $user = User::find($authUser->id);
            $token = $user->createToken('auth_token')->plainTextToken;
            $status = 200;
        } else {
            $status = 400;
        }

        return [
            'status' => $status,
            'token' => $token
        ];
    }

    public function logout(Request $request)
    {
        if (!empty($request->user()->currentAccessToken())) {
            $request->user()->currentAccessToken()->delete();

            return [
                'status' => 200,
                'message' => 'success'
            ];
        }

        return [
            'status' => 400,
            'message' => 'fail'
        ];
    }
}
