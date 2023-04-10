<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\UserFollowed;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Notification;
use App\Repositories\User\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getUsers()
    {
        $users = $this->userRepository->getUsers();

        $status = 'success';
        if (empty($users)) {
            $status = 'no_record';
        }

        return view('users.index', compact('users'));
    }

    public function getUserDetail($id)
    {
        $user = User::with('posts')->find($id);
        $user = new UserResource($user);

        if (!empty($user)) {
            $userValue = Cache::remember('user:profile:' . $user->id, config('generate.cache_expiration'), function () use ($user) {
                return $user;
            });

            return [
                'status' => 'success',
                'data' => $userValue,
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
            'role_id' => $request->role_id,
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
                'role_id' => $request->role_id,
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

    public function getFollowUsers(Request $request)
    {
        $users = $this->userRepository->getFollowUsers();

        return view('users.follow', compact('users'));
    }

    public function follow(int $id)
    {
        /** @var User $loginUser */
        $loginUser = auth()->user();
        $followerUser = $this->userRepository->findById($id);

        if (is_null($followerUser)) {
            // TODO:
        }

        if ($loginUser->id == $followerUser->id) {
            return back()->withError("You can't follow yourself");
        }

        if(!$loginUser->isFollowing($followerUser->id)) {
            $loginUser->follow($followerUser->id);

            // sending a notification
            Notification::send($followerUser, new UserFollowed($loginUser));

            return back()->withSuccess("You are now friends with {$followerUser->name}");
        }

        return back()->withError("You are already following {$followerUser->name}");
    }

    public function unfollow(int $id)
    {
        /** @var User $loginUser */
        $loginUser = auth()->user();
        $followerUser = $this->userRepository->findById($id);

        if($loginUser->isFollowing($followerUser->id)) {
            $loginUser->unfollow($followerUser->id);
            return back()->withSuccess("You are no longer friends with {$followerUser->name}");
        }

        return back()->withError("You are not following {$followerUser->name}");
    }
}
