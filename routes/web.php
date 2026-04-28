<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdministrationController;
use App\Http\Controllers\LeaveController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('permissions',PermissionController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('users',UserController::class);
    Route::resource('administrations',AdministrationController::class);
    Route::resource('leave',LeaveController::class);

    Route::post('/leave/{leave}/approve', [LeaveController::class, 'approve'])
        ->name('leave.approve');
    Route::post('/leave/{leave}/reject', [LeaveController::class, 'reject'])
        ->name('leave.reject');
    Route::get('/dashboard',[LeaveController::class, 'dashboard'])->name('leave.dashboard');
});

require __DIR__.'/auth.php';
