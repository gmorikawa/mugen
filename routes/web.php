<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\HomeController;

Route::get('/', [HomeController::class, 'welcome']);

Route::get('/login', [AuthenticationController::class, 'login']);
Route::post('/login', [AuthenticationController::class, 'authenticate']);
Route::post('/logout', [AuthenticationController::class, 'logout']);
