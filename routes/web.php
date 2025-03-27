<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// admin
use App\Http\Controllers\admin\InternetRequestDashboardController;
use App\Http\Controllers\admin\SystemRequestDashboardController;

// user
use App\Http\Controllers\user\InternetRequestFormController;
use App\Http\Controllers\user\SystemRequestFormController;

Route::middleware('guest')->group(function () {
    Route::get('/', [LoginController::class,'index'])->name('login');
    Route::post('/', [LoginController::class,'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/internet-requests', [InternetRequestDashboardController::class,'index'])->name('admin.internet-requests');
    Route::get('/admin/system-requests', [SystemRequestDashboardController::class,'index'])->name('admin.system-requests');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/new-internet-request', [InternetRequestFormController::class,'index'])->name('user.new-internet-request');
    Route::get('/user/new-system-request', [SystemRequestFormController::class,'index'])->name('user.new-system-request');
});