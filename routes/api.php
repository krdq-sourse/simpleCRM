<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/auth/register', [AuthController::class, 'createUser'])->name('api.register');
Route::post('/auth/login', [AuthController::class, 'loginUser'])->name('api.login');
Route::apiResource('company', CompanyController::class)->middleware('auth:sanctum');
Route::get('get-client-companies', [CompanyController::class, 'getClientCompanies'])
    ->name('get-client-companies')->middleware('auth:sanctum');
Route::apiResource('client', UserController::class)->middleware('auth:sanctum');
