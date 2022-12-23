<?php

namespace App\Http\Controllers\Social;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function index()
    {
        return 'chinh sach rieng tu';
    }

    public function redirect($platform)
    {
        return Socialite::driver($platform)->redirect();
    }

    public function callback($platform)
    {
        $userSocial = Socialite::driver($platform)->user();

        $userResult = User::updateOrCreate([
            'provider_id' => $userSocial->id,
        ], [
            'name' => $userSocial->name,
            'email' => $userSocial->email,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'provider' => $platform,
            'provider_id' => $userSocial->id,
        ]);
        if (!$userResult) {
            return view('errors.404');
        }

        $user = User::find($userResult->id);
        Auth::login($user, true);
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('get_login');
    }
}
