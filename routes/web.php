<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;


Route::get('/',                [HomeController::class, 'index'])->name('home.index');

Route::group(['prefix' => 'admin'], function () {
    Route::get('/',            [AdminController::class, 'dashboard'])->middleware('auth:admin')->name('admin.dashboard');
    Route::get('/login',       [AdminController::class, 'index'])->name('admin.index');
    Route::get('/logout',      [AdminController::class, 'logout'])->name('admin.logout');
    Route::post('/login',      [AdminController::class, 'login'])->name('admin.login');

    Route::group(['prefix' => 'bank',], function () {
        Route::post('/add',    [AdminController::class, 'bankAdd'])->middleware('auth:admin')->name('admin.bank.add');
    });
});

Route::group(['prefix' => 'account'], function () {
    Route::get('/',            [UserController::class, 'dashboard'])->middleware('auth')->name('user.dashboard');
    Route::get('/login',       [UserController::class, 'index'])->name('user.index');
    Route::get('/logout',      [UserController::class, 'logout'])->name('user.logout');
    Route::post('/login',      [UserController::class, 'login'])->name('user.login');
    Route::post('/register',   [UserController::class, 'register'])->name('user.register');

    Route::get('/revoke/key/api',      [UserController::class, 'revokeApiKey'])->name('user.revoke.api.key');
    Route::get('/revoke/key/widget',   [UserController::class, 'revokeWidgetKey'])->name('user.revoke.widget.key');
});
