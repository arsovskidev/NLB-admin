<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Admin\Auth\LoginController;


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
