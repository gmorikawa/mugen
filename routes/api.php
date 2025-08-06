<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\CountryController;
use App\Http\Controllers\API\FileController;

Route::get('/countries', [CountryController::class, 'getAll']);
Route::get('/countries/{id}', [CountryController::class, 'getById']);
Route::post('/countries', [CountryController::class, 'create']);
Route::patch('/countries/{id}', [CountryController::class, 'update']);
Route::delete('/countries/{id}', [CountryController::class, 'remove']);

Route::get('/companies', [CompanyController::class, 'getAll']);
Route::get('/companies/{id}', [CompanyController::class, 'getById']);
Route::post('/companies', [CompanyController::class, 'create']);
Route::patch('/companies/{id}', [CompanyController::class, 'update']);
Route::delete('/companies/{id}', [CompanyController::class, 'remove']);

Route::get('/files', [FileController::class, 'getAll']);
Route::get('/files/{id}', [FileController::class, 'getById']);
Route::post('/files', [FileController::class, 'create']);
Route::patch('/files/{id}', [FileController::class, 'update']);
Route::delete('/files/{id}', [FileController::class, 'remove']);
Route::post('/files/{id}/upload', [FileController::class, 'upload']);
Route::get('/files/{id}/download', [FileController::class, 'download']);