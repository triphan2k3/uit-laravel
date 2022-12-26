<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JoinMatchController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/chessboard', function () {
    return view('chessboard');
})->middleware(['auth'])->name('chessboard');

Route::get('/play', function () {
    return view('play');
})->middleware(['auth'])->name('play');

Route::get('/join');

Route::resource('/users', UserController::class)->name('*', 'users');

Route::get('/join', JoinMatchController::class)->name('join');

require __DIR__.'/auth.php';
