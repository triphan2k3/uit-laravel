<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\DB;
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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view('/profile', 'profile')
    ->name('profile');


    Route::put('profile', [ProfileController::class, 'update'])
    ->name('profile.update');

    Route::middleware(['isAdmin'])->group(function() {
        Route::view('admin', 'admin')
        ->name('admin');

        Route::get('admin/profile/{id?}', function($id) {
            $role = DB::table('users')->where('id', $id)->first()->role;
            if ($role == 'user')
                return view('admin-profile')->with('id', $id);
            else
                return redirect()->route('admin');
        })->name('admin.profile');

        Route::put('admin/profile', [ProfileController::class, 'admin_update'])
        ->name('admin.profile.update');

        Route::get('admin/profile/{id?}/delete', function($id) {
            $role = DB::table('users')->where('id', $id)->first()->role;
            if ($role == 'user')
                DB::table('users')->where('id', $id)->delete();
            return redirect()->route('admin');
        })->name('admin.profile.delete');
    });
    
    Route::middleware(['isOwner'])->group(function() {
        Route::view('owner', 'owner')
        ->name('owner');

        Route::get('owner/profile/{id?}', function($id) {
            $role = DB::table('users')->where('id', $id)->first()->role;
            if ($role == 'user' || $role == 'admin')
                return view('owner-profile')->with('id', $id);
            else
                return redirect()->route('owner');
        })->name('owner.profile');

        Route::put('owner/profile', [ProfileController::class, 'owner_update'])
        ->name('owner.profile.update');

        Route::get('owner/profile/{id?}/delete', function($id) {
            $role = DB::table('users')->where('id', $id)->first()->role;
            if ($role == 'user' || $role == 'admin')
                DB::table('users')->where('id', $id)->delete();
            return redirect()->route('owner');
        })->name('owner.profile.delete');
    });
});

require __DIR__.'/auth.php';
