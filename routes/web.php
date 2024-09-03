<?php
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

Route::any('/{any}', [ClientController::class, 'index'])->where('any', '^(?!api).*$');
