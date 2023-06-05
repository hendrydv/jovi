<?php

use App\Http\Controllers\DownloadPdfController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/', [HomeController::class, 'home'])->name('home');
// });

// Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/{record}/pdf', [DownloadPdfController::class, 'download'])->name('download.pdf');

// Route::any('/login', [UserController::class, 'login'])->name('login');
