<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

$adminSecretPath = env('ADMIN_SECRET_PATH', 'console-fh927');

Route::middleware('guest')->group(function () use ($adminSecretPath) {
    // Secret Login Route (Protected by Rate Limiter)
    Route::get($adminSecretPath, [AuthenticatedSessionController::class, 'create'])
        ->middleware('throttle:10,1')
        ->name('login');

    Route::post($adminSecretPath, [AuthenticatedSessionController::class, 'store'])
        ->middleware('throttle:5,1');

    // Honeypot redirects for visitors/bots attempting default auth URLs
    Route::any('login', fn () => redirect('/'));
    Route::any('register', fn () => redirect('/'));
    Route::any('forgot-password', fn () => redirect('/'));
    Route::any('reset-password', fn () => redirect('/'));
    Route::any('reset-password/{token}', fn () => redirect('/'));
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
