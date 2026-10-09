<?php

use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ExpertiseController;
use App\Http\Controllers\Api\McpController;
use App\Http\Controllers\Api\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes for External Integration (MCP / AI Agent)
|--------------------------------------------------------------------------
|
| These routes are loaded by bootstrap/app.php and are prefixed with /api.
|
*/

// MCP (Model Context Protocol) Remote Server Endpoint (SSE & JSON-RPC)
Route::match(['get', 'post', 'options'], '/mcp', [McpController::class, 'handle'])->name('api.mcp');

// Protected REST API Endpoints (Requires X-API-KEY header)
Route::middleware('api.key')->group(function () {
    // Contacts (Inbox)
    Route::get('/contacts', [ContactController::class, 'index'])->name('api.contacts.index');

    // Projects (Portfolio)
    Route::get('/projects', [ProjectController::class, 'index'])->name('api.projects.index');
    Route::post('/projects', [ProjectController::class, 'store'])->name('api.projects.store');
    Route::match(['put', 'patch', 'post'], '/projects/{id}', [ProjectController::class, 'update'])->name('api.projects.update');

    // Certificates
    Route::get('/certificates', [CertificateController::class, 'index'])->name('api.certificates.index');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('api.certificates.store');

    // Articles (Blog)
    Route::get('/articles', [\App\Http\Controllers\Api\ArticleController::class, 'index'])->name('api.articles.index');
    Route::post('/articles', [\App\Http\Controllers\Api\ArticleController::class, 'store'])->name('api.articles.store');
    Route::match(['put', 'patch', 'post'], '/articles/{id}', [\App\Http\Controllers\Api\ArticleController::class, 'update'])->name('api.articles.update');

    // Expertise
    Route::get('/expertise', [ExpertiseController::class, 'index'])->name('api.expertise.index');
    Route::post('/expertise', [ExpertiseController::class, 'store'])->name('api.expertise.store');
    Route::match(['put', 'patch', 'post'], '/expertise/{id}', [ExpertiseController::class, 'update'])->name('api.expertise.update');
    Route::delete('/expertise/{id}', [ExpertiseController::class, 'destroy'])->name('api.expertise.destroy');
});
