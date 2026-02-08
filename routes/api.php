<?php

use Illuminate\Support\Facades\Route;

use App\Application\Controller\API\AuthController;
use App\Application\Controller\API\UserController;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\GameController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\LanguageController;
use App\Http\Controllers\API\PlatformController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ColorEncodingController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/system-setup', [AuthController::class, 'systemSetup']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::patch('/email-confirmation', [AuthController::class, 'confirmEmail']);
});

Route::group(
    [
        'middleware' => ['auth:sanctum'],
        'prefix' => 'users'
    ],
    function () {
        Route::get('/', [UserController::class, 'getAll']);
        Route::get('/{id}', [UserController::class, 'getById']);
        Route::get('/{id}/profile/avatar', [UserController::class, 'downloadProfileAvatar']);
        Route::post('/', [UserController::class, 'create']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::post('/{id}/profile/avatar', [UserController::class, 'updateProfileAvatar']);
        Route::delete('/{id}', [UserController::class, 'remove']);
    }
);

Route::group(['prefix' => 'countries'], function () {
    Route::get('/', [CountryController::class, 'getAll']);
    Route::get('/{id}', [CountryController::class, 'getById']);
    Route::post('/', [CountryController::class, 'create']);
    Route::patch('/{id}', [CountryController::class, 'update']);
    Route::delete('/{id}', [CountryController::class, 'remove']);
});

Route::group(['prefix' => 'companies'], function () {
    Route::get('/', [CompanyController::class, 'getAll']);
    Route::get('/{id}', [CompanyController::class, 'getById']);
    Route::post('/', [CompanyController::class, 'create']);
    Route::patch('/{id}', [CompanyController::class, 'update']);
    Route::delete('/{id}', [CompanyController::class, 'remove']);
});

Route::group(['prefix' => 'platforms'], function () {
    Route::get('/', [PlatformController::class, 'getAll']);
    Route::get('/{id}', [PlatformController::class, 'getById']);
    Route::post('/', [PlatformController::class, 'create']);
    Route::patch('/{id}', [PlatformController::class, 'update']);
    Route::delete('/{id}', [PlatformController::class, 'remove']);
});

Route::group(['prefix' => 'categories'], function () {
    Route::get('/', [CategoryController::class, 'getAll']);
    Route::get('/{id}', [CategoryController::class, 'getById']);
    Route::post('/', [CategoryController::class, 'create']);
    Route::patch('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'remove']);
});

Route::group(['prefix' => 'games'], function () {
    Route::get('/', [GameController::class, 'getAll']);
    Route::get('/{id}', [GameController::class, 'getById']);
    Route::post('/', [GameController::class, 'create']);
    Route::patch('/{id}', [GameController::class, 'update']);
    Route::delete('/{id}', [GameController::class, 'remove']);
});

Route::group(['prefix' => 'color-encodings'], function () {
    Route::get('/', [ColorEncodingController::class, 'getAll']);
    Route::get('/{id}', [ColorEncodingController::class, 'getById']);
    Route::post('/', [ColorEncodingController::class, 'create']);
    Route::patch('/{id}', [ColorEncodingController::class, 'update']);
    Route::delete('/{id}', [ColorEncodingController::class, 'remove']);
});

Route::group(['prefix' => 'images'], function () {
    Route::get('/', [ImageController::class, 'getAll']);
    Route::get('/{id}', [ImageController::class, 'getById']);
    Route::post('/', [ImageController::class, 'create']);
    Route::patch('/{id}', [ImageController::class, 'update']);
    Route::delete('/{id}', [ImageController::class, 'remove']);
});

Route::group(['prefix' => 'languages'], function () {
    Route::get('/', [LanguageController::class, 'getAll']);
    Route::get('/{id}', [LanguageController::class, 'getById']);
    Route::post('/', [LanguageController::class, 'create']);
    Route::patch('/{id}', [LanguageController::class, 'update']);
    Route::delete('/{id}', [LanguageController::class, 'remove']);
});
