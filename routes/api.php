<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ProvidedServicesController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('users/authorize', [AdminController::class, 'authorizeUser']);
    Route::apiResource('provided-services', ProvidedServicesController::class);
    Route::apiResource('addresses', AddressController::class);
    Route::apiResource('contacts', ContactsController::class);
    Route::apiResource('pictures', PictureController::class)->except(['show', 'update']);
});

Route::get('ongs', [SearchController::class, 'searchOngsByDistance']);
