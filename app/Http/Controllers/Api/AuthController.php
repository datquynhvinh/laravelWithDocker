<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $checkLogin = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($checkLogin) {
            $client = Client::where('password_client', 1)->first();
            if ($client) {
                $response = Http::asForm()->post('http://127.0.0.1:8002/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => $client->id,
                    'client_secret' => $client->secret,
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '',
                ]);

                return $response;
            }
        }

        return [
            'message' => 'fail'
        ];
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return [
            'status' => 200,
            'message' => 'success'
        ];
    }

    public function refreshToken(Request $request)
    {
        $client = Client::where('password_client', 1)->first();
        $response = Http::asForm()->post('http://127.0.0.1:8002/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->token,
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'scope' => '',
        ]);

        return $response;
    }
}
