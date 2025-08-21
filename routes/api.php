<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ColorEncodingController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\FileController;
use App\Http\Controllers\API\GameController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\PlatformController;

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

Route::group(['prefix' => 'files'], function () {
    Route::get('/', [FileController::class, 'getAll']);
    Route::get('/{id}', [FileController::class, 'getById']);
    Route::post('/', [FileController::class, 'create']);
    Route::patch('/{id}', [FileController::class, 'update']);
    Route::delete('/{id}', [FileController::class, 'remove']);
    Route::post('/{id}/upload', [FileController::class, 'upload']);
    Route::get('/{id}/download', [FileController::class, 'download']);
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
