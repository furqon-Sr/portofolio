<?php

use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for External Integration (MCP / AI Agent)
|--------------------------------------------------------------------------
|
| These routes are loaded by bootstrap/app.php and are prefixed with /api.
| Protected by the ApiKeyMiddleware which requires a valid X-API-KEY header.
|
*/

Route::middleware('api.key')->group(function () {
    // Contacts (Inbox)
    Route::get('/contacts', [ContactController::class, 'index'])->name('api.contacts.index');

    // Projects (Portfolio)
    Route::get('/projects', [ProjectController::class, 'index'])->name('api.projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('api.projects.store');

    // Certificates
    Route::get('/certificates', [CertificateController::class, 'index'])->name('api.certificates.index');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('api.certificates.store');
});
