<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Web\UserController;
use App\Http\Controllers\Web\AuthenticationController;
use App\Http\Controllers\Web\HomeController;

Route::get('/', [HomeController::class, 'welcome']);

Route::get('/login', [AuthenticationController::class, 'login']);
Route::post('/login', [AuthenticationController::class, 'authenticate']);
Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'dashboard']);
    // Route::redirect('settings', 'settings/profile');

    // Route::get('settings/profile', Profile::class)->name('settings.profile');
    // Route::get('settings/password', Password::class)->name('settings.password');
    // Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('/users', [UserController::class, 'list']);
    Route::get('/users/create', [UserController::class, 'createForm']);
    Route::post('/users/create', [UserController::class, 'create']);
});
