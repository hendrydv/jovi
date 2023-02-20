<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'home'])->name('home');
});

Route::any('/login', [UserController::class, 'login'])->name('login');
