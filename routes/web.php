<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AllUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index']);

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');
Route::get('/akun', [UserController::class, 'ubahpassword'])->middleware('auth');
Route::post('/akun', [UserController::class, 'passwordupdate'])->middleware('auth');
Route::get('/user', [UserController::class, 'index'])->middleware('auth');
Route::post('/useradd', [UserController::class, 'store'])->middleware('auth');
Route::resource('/users', AllUserController::class)->middleware('auth');
