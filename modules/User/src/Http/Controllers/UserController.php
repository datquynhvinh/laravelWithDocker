<?php

namespace Modules\User\src\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return view('user::index');
    }

    public function detail($id) {
        return view('user::user-detail');
    }
}
