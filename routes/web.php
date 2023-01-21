<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\DashboardController;
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

Route::middleware('auth')->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/', [BookController::class, 'index']);
    Route::get('/add-book', [BookController::class, 'addBook']);
    Route::post('/store-book', [BookController::class, 'storeBook']);
    Route::get('/edit/{bookID}/book', [BookController::class, 'editBook']);
    Route::post('/update/{bookID}/book', [BookController::class, 'updateBook']);
    Route::get('/delete/{bookID}/book', [BookController::class, 'deleteBook']);
});
