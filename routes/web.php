<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

// Rotas públicas
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rotas protegidas
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
