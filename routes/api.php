<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\CountryController;

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