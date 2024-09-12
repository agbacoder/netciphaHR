<?php
use Illuminate\Http\Request;
use Illuminate\Routing\Route as RoutingRoute;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordConroller;
use App\Http\Controllers\ResetPasswordController;

Route::controller(AuthController::class)->group(function() {
    Route::post('/login', 'login');

    // Route::get('forgot-password', 'forgotPassword')->name('password.email');
    // Route::post('forgot-password', 'sendResetLink')->name('password.request');
    // Route::get('reset-password/{token}', 'resetPassword')->name('password.reset');
    // Route::post('reset-password', 'updatePassword')->name('password.update');
});
Route::middleware('auth:api')->group(function () {
    Route::post('/profile', [AuthController::class, 'profile']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Add more routes that require authentication here...
});

Route::post('/password/email', [ForgotPasswordConroller::class, 'sendResetEmailLink']);
Route::post('/password/reset', [ResetPasswordController::class, 'resetPassword'])->name('password.reset');



