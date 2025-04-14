<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestController::class, "index"]);
Route::get('/redirect', [AuthController::class, "redirectAuth"]);
Route::get('/callback', [AuthController::class, "callbackAuth"]);

Route::get('/logout', [AuthController::class, "logout"]);
