<?php

namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\User\src\Repositories\UserRepository;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        $users = $this->userRepository->getAll();

        return view('user::index', [
            'users' => $users,
        ]);
    }

    public function detail($id) {
        return view('user::user-detail');
    }
}
