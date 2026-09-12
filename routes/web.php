<?php

use App\Http\Controllers\Admin\MotorCategoryController;
use App\Http\Controllers\Admin\MotorController as AdminMotorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MotorController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/motors', [MotorController::class, 'index'])->name('motors.index');
Route::get('/motors/{motor}', [MotorController::class, 'show'])->name('motors.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');

        Route::resource('categories', MotorCategoryController::class)->except('show');
        Route::resource('motors', AdminMotorController::class)->except('show');
    });

    Route::middleware('role:owner')->prefix('owner')->name('owner.')->group(function () {
        Route::get('/dashboard', function () {
            return view('owner.dashboard');
        })->name('dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
