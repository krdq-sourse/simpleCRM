<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('company', CompanyController::class);
Route::resource('client', UserController::class);
Route::get('get-companies', [CompanyController::class, 'viewIndexAction'])
    ->name('company.view.index');
Route::get('get-clients', [UserController::class, 'viewIndexAction'])
    ->name('client.view.index');

Auth::routes();
