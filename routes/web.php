<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clients', ClientController::class);
Route::get('/ayuda', [ClientController::class, 'helper'])->name('help.index');
