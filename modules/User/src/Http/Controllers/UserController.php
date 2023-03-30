<?php

namespace Modules\User\src\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        return '<h1>User Module</h1>';
    }

    public function detail($id) {
        return '<h1>User Detail</h1>';
    }
}
