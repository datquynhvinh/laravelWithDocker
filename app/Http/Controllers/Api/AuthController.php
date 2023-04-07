<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Passport\Client;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Client\Response|array
     */
    public function login(Request $request)
    {
        $checkLogin = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ], true);

        if ($checkLogin) {
            $client = Client::where('password_client', 1)->first();
            if ($client) {
                $response = Http::asForm()->post($client->redirect . '/oauth/token', [
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

    /**
     * @param Request $request
     * @return array
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return [
            'status' => 200,
            'message' => 'success'
        ];
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Client\Response
     */
    public function refreshToken(Request $request)
    {
        $client = Client::where('password_client', 1)->first();
        $response = Http::asForm()->post($client->redirect . '/oauth/token', [
            'grant_type' => 'refresh_token',
            'refresh_token' => $request->token,
            'client_id' => $client->id,
            'client_secret' => $client->secret,
            'scope' => '',
        ]);

        return $response;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Client\Response|array
     */
    public function register(Request $request) {
        $this->validation($request);
        $user = new User;
        $createUser = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);

        if (!$createUser) {
            $client = Client::where('password_client', 1)->first();
            if ($client) {
                $response = Http::asForm()->post($client->redirect . '/oauth/token', [
                    'grant_type' => 'password',
                    'client_id' => $client->id,
                    'client_secret' => $client->secret,
                    'username' => $createUser->email,
                    'password' => $createUser->password,
                    'scope' => '',
                ]);

                return $response;
            }
        }

        return [
            'msg' => 'Success'
        ];
    }

    /**
     * Validate request
     *
     * @param Request $request
     * @return void
     */
    private function validation($request): void
    {
        $rule = [
            'name' => 'required|min:5',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ];

        $message = [
            'name.required' => "Ten bat buoc phai nhap",
            'name.min' => "Ten phai lon hon :min ki tu",
            'email.required' => "Email bat buoc phai nhap",
            'email.email' => "Email khong dung dinh dang",
            'password.required' => "Password bat buoc phai nhap",
            'password.min' => "Password phai lon hon :min ki tu",
        ];

        $request->validate($rule, $message);
    }
}
