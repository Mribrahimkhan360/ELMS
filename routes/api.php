<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
<<<<<<< HEAD
=======
use App\Http\Controllers\Api\ApiLeaveController;
use App\Http\Controllers\Api\PermissionController;
>>>>>>> c071558 (api)


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/login', [AuthController::class, 'login']);

<<<<<<< HEAD
=======
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/leave/store', [ApiLeaveController::class, 'store']);
    Route::get('/leave/profile', [ApiLeaveController::class, 'profile']);
    Route::post('/leave/logout',[ApiLeaveController::class,'logout']);

    // Permission
    Route::post('/leave/permission', [PermissionController::class, 'store']);

});

>>>>>>> c071558 (api)
