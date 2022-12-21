<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return 'All users';
    }
    
    public function getUserDetail(User $user)
    {
        return 'User ' . $user;
    }

    public function createUser(Request $request, User $user)
    {
        // $rule = [
        //     'name' => 'required|min:5',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:8',
        // ];
    
        // $message = [
        //     'name.required' => "Ten bat buoc phai nhap",
        //     'name.min' => "Ten phai lon hon :min ki tu",
        //     'email.required' => "Email bat buoc phai nhap",
        //     'email.email' => "Email khong dung dinh dang",
        //     'email.unique' => "Email da ton tai",
        //     'password.required' => "Ten bat buoc phai nhap",
        //     'password.min' => "Ten phai lon hon :min ki tu",
        // ];

        // $request->validate($rule, $message);
        dd($user->find(1));
    }

    public function updateUser(Request $request)
    {
        return $request->all();
    }
}
