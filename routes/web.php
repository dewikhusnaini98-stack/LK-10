<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Redirect root to login page
Route::get('/', function () {
    return redirect()->route('login');
});

// Render the login view
Route::get('/login', function () {
    return view('login');
})->name('login');

// Initiate WorkOS OAuth redirect
Route::get('/login/workos', [AuthController::class, 'login'])->name('login.workos');

// Callback endpoint for WorkOS OAuth
Route::get('/auth/callback', [AuthController::class, 'callback'])->name('auth.callback');

// Handle user logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Protected Routes (Authenticated Users Only)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::resource('books', BookController::class)->except(['show']);
});