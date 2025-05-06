<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;

// admin
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\InternetRequestsController;
use App\Http\Controllers\admin\SystemRequestsController;

// user
use App\Http\Controllers\user\InternetRequestController;
use App\Http\Controllers\user\SystemRequestController;

Route::middleware('guest')->group(function () {
    Route::get('/', [HomeController::class,'index'])->name('home');
    Route::post('/', [LoginController::class,'login'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class,'index'])->name('admin.dashboard.index');
        Route::get('/refresh', [DashboardController::class, 'refresh'])->name('admin.dashboard.refresh');
    });

    Route::prefix('requests')->group(function () {
        Route::prefix('internet')->group(function () {
            Route::get('/', [InternetRequestsController::class, 'index'])->name('admin.requests.internet');
            Route::get('/show', [InternetRequestsController::class, 'show'])->name('admin.requests.internet.show');
            Route::get('/print/{id}', [InternetRequestsController::class, 'print'])->name('admin.print.request.internet');
        });

        Route::prefix('system')->group(function () {
            Route::get('/', [SystemRequestsController::class, 'index'])->name('admin.requests.system');
            Route::get('/show', [SystemRequestsController::class, 'show'])->name('admin.requests.system.show');
            Route::get('/print/{id}', [SystemRequestsController::class, 'print'])->name('admin.print.request.system');
        });
    });
});

Route::prefix('user')->middleware(['auth', 'role:user'])->group(function () {
    Route::prefix('request')->group(function () {
        Route::prefix('internet')->group(function () {
            Route::get('/', [InternetRequestController::class,'index'])->name('user.request.internet');
            Route::post('/store', [InternetRequestController::class,'store'])->name('user.request.internet.store');
            Route::get('/print/{id}', [InternetRequestController::class, 'print'])->name('user.print.request.internet');
        });

        Route::prefix('system')->group(function () {
            Route::get('/', [SystemRequestController::class,'index'])->name('user.request.system');
            Route::post('/store', [SystemRequestController::class,'store'])->name('user.request.system.store');
            Route::get('/print/{id}', [SystemRequestController::class,'print'])->name('user.print.request.system');
        });
    });
});