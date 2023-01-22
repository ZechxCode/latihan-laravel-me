<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', [DashboardController::class, 'index']);
// Route::get('/dashboard/{number}/show', [DashboardController::class, 'show']);

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'storeLogin']);
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'storeRegister'])->name('register.store');
Route::get('/otp/{id}', [UserController::class, 'viewOtp'])->name('otp');
Route::post('/otp/{id}', [UserController::class, 'checkOtp'])->name('otp.verify');


// Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->name('forgot.password')->middleware('guest');
// Route::post('/forgot-password', [ResetPasswordController::class, 'findAccountByEmail'])->name('forgot.password')->middleware('guest');

Route::middleware(['guest'])->group(function () {
    Route::get('/forgot-password', [ResetPasswordController::class, 'index'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'findAccountByEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'resetPasswordForm'])->name('password.reset');
    Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('password.update');
});

Route::middleware(['auth', 'account.verified'])->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');

    Route::get('/', [BookController::class, 'index']);
    Route::get('/add-book', [BookController::class, 'addBook']);
    Route::post('/store-book', [BookController::class, 'storeBook']);
    Route::get('/edit/{bookID}/book', [BookController::class, 'editBook']);
    Route::post('/update/{bookID}/book', [BookController::class, 'updateBook']);
    Route::get('/delete/{bookID}/book', [BookController::class, 'deleteBook']);
});
