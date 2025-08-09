<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\FileController;
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
