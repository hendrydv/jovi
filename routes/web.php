<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::group(['middleware' => ['auth']], function () {
//     Route::get('/', [HomeController::class, 'home'])->name('home');
// });

// Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/{record}/pdf', [DownloadController::class, 'downloadPdf'])->name('download.pdf');

Route::get('/{record}/excel', [DownloadController::class, 'downloadExcel'])->name('download.excel');

// Route::any('/login', [UserController::class, 'login'])->name('login');
