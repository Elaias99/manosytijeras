<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware(['auth', 'nocache'])->group(function () {
    Route::resource('clients', ClientController::class);
    Route::get('/ayuda', [ClientController::class, 'helper'])->name('help.index');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});