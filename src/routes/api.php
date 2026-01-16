<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PasswordResetController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;


Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login'])->middleware('throttle:60,1');

Route::post('/forgot-password',[PasswordResetController::class,'sendResetLink'])->middleware('throttle:60,1');    ;
Route::post('/reset-password',[PasswordResetController::class,'reset']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/logout',[AuthController::class,'logout']);

    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/export-users-pdf',[PdfController::class,'export']);
    });

    Route::middleware('role:user')->group(function () {
        Route::get('/user/profile', fn() => auth()->user());
    });
});
