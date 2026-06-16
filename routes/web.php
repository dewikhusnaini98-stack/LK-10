<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| LOGIN PAGE (UI)
|--------------------------------------------------------------------------
| Ini halaman awal yang dilihat user
*/
Route::get('/', function () {
    return view('login'); 
})->name('login.page');

/*
|--------------------------------------------------------------------------
| WORKOS AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| PROTECTED ROUTES (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class);
});

Route::get('/login', function () {
    return view('login');
})->name('login.page');

Route::get('/login/workos', [AuthController::class, 'login'])
    ->name('login.workos');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');