<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome(Request $request): View 
    {
        return view('welcome');
    }

    public function dashboard(Request $request): View
    {
        return view('dashboard', [
            'title' => 'Dashboard'
        ]);
    }
}
