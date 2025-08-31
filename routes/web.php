<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\HomeController;
use Illuminate\Http\Request;

Route::get('/', [HomeController::class, 'welcome']);
Route::get('/dashboard', [HomeController::class, 'dashboard']);

Route::get('/login', [AuthenticationController::class, 'login']);
Route::post('/login', [AuthenticationController::class, 'authenticate']);
Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::get('/users', [UserController::class, 'list']);

Route::get('/dump', function(Request $request) {
    return var_dump($request);
});