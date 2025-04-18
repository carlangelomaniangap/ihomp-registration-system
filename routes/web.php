<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

// admin
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\InternetRequestsController;
use App\Http\Controllers\admin\SystemRequestsController;

// user
use App\Http\Controllers\user\InternetRequestController;
use App\Http\Controllers\user\SystemRequestController;

Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class,'index']);
    Route::post('/', [LoginController::class,'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class,'index'])->name('admin.dashboard.index');

    Route::get('/admin/requests/internet', [InternetRequestsController::class,'index'])->name('admin.requests.internet');
    Route::get('/admin/requests/internet/show', [InternetRequestsController::class,'show'])->name('admin.requests.internet.show');
    
    Route::get('/admin/requests/system', [SystemRequestsController::class,'index'])->name('admin.requests.system');
    Route::get('/admin/requests/system/show', [SystemRequestsController::class,'show'])->name('admin.requests.system.show');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/request/internet', [InternetRequestController::class,'index'])->name('user.request.internet');
    Route::post('/user/request/internet/store', [InternetRequestController::class,'store'])->name('user.request.internet.store');

    Route::get('/user/request/system', [SystemRequestController::class,'index'])->name('user.request.system');
    Route::post('/user/request/system/store', [SystemRequestController::class,'store'])->name('user.request.system.store');
});