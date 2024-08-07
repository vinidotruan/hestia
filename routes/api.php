<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SearchController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('users/authorize', [AdminController::class, 'authorizeUser']);
});

Route::get('ongs', [SearchController::class, 'searchOngsByDistance']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
