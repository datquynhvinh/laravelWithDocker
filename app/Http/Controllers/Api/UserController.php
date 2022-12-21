<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{
    public function getUsers()
    {
        $users = User::with('posts')->paginate();

        $status = 'success';
        if (empty($users)) {
            $status = 'no_record';
        }

        return new UserCollection($users, $status);
    }
     
    public function getUserDetail($id)
    {
        $user = User::with('posts')->find($id);
        $user = new UserResource($user);

        if (!empty($user)) {
            return [
                'status' => 'success',
                'data' => $user
            ];
        }

        return [
            'status' => 'fail',
            'data' => []
        ];
    }

    public function createUser(Request $request)
    {
        $this->validation($request);
        $user = new User;

        $createUser = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (!$createUser) {
            return [
                'msg' => 'Fail'
            ];
        }
        return [
            'msg' => 'Success'
        ];
    }

    public function updateUser(Request $request, $id)
    {
        $this->validation($request);
        $user = new User;

        $updateUser = $user->updateOrCreate(
            [
                'id' => $id, 
            ],
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]
        );

        if ($updateUser) {
            return [
                'msg' => 'Success'
            ];
        }
        return [
            'msg' => 'Fail'
        ];
    }

    public function deleteUser($id)
    {
        $deleteUser = User::destroy($id);
        if ($deleteUser) {
            return [
                'msg' => 'Success'
            ];
        }
        return [
            'msg' => 'Fail'
        ];
    }

    private function validation($request)
    {
        $rule = [
            'name' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
        ];
    
        $message = [
            'name.required' => "Ten bat buoc phai nhap",
            'name.min' => "Ten phai lon hon :min ki tu",
            'email.required' => "Email bat buoc phai nhap",
            'email.email' => "Email khong dung dinh dang",
            'email.unique' => "Email da ton tai",
            'password.required' => "Password bat buoc phai nhap",
            'password.min' => "Password phai lon hon :min ki tu",
        ];

        $request->validate($rule, $message);
    }
}
