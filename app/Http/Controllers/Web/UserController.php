<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function list(Request $request): View
    {
        $service = new UserService();

        return view('user.list-users', [
            'users' => $service->getAll()
        ]);
    }
}
