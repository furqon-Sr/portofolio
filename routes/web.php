<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Project;

// Home Page - Dynamicized
Route::get('/', function () {
    Project::seedIfEmpty();
    \App\Models\AboutSetting::seedIfEmpty();
    \App\Models\AboutBox::seedIfEmpty();
    \App\Models\Expertise::seedIfEmpty();

    $projects = Project::orderBy('id', 'asc')->take(6)->get(); // Show first 6 on home page
    $aboutText = \App\Models\AboutSetting::first()->about_text ?? '';
    $aboutBoxes = \App\Models\AboutBox::orderBy('id', 'asc')->get();
    $expertises = \App\Models\Expertise::orderBy('id', 'asc')->get();

    return view('welcome', compact('projects', 'aboutText', 'aboutBoxes', 'expertises'));
});

// Works Page - Dynamicized
Route::get('/works', function () {
    Project::seedIfEmpty();
    $projects = Project::orderBy('id', 'asc')->get();
    return view('works', compact('projects'));
})->name('works.show');

Route::get('/contact', function () {
    return view('contact'); 
})->name('contact.show');

// Contact Form Submit
Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.store');

// PROTECTED ADMIN ROUTES
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Redirect /dashboard to the new Admin Dashboard
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');

    // Admin Panel Actions
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/messages', [AdminController::class, 'messages'])->name('admin.messages');
    
    // Admin Project CRUD
    Route::get('/admin/projects', [AdminController::class, 'projects'])->name('admin.projects.index');
    Route::get('/admin/projects/create', [AdminController::class, 'createProject'])->name('admin.projects.create');
    Route::post('/admin/projects', [AdminController::class, 'storeProject'])->name('admin.projects.store');
    Route::get('/admin/projects/{id}/edit', [AdminController::class, 'editProject'])->name('admin.projects.edit');
    Route::put('/admin/projects/{id}', [AdminController::class, 'updateProject'])->name('admin.projects.update');
    Route::delete('/admin/projects/{id}', [AdminController::class, 'deleteProject'])->name('admin.projects.delete');

    // Admin About Me & Expertise Section CRUD
    Route::get('/admin/about', [AdminController::class, 'about'])->name('admin.about');
    Route::put('/admin/about/text', [AdminController::class, 'updateAboutText'])->name('admin.about.text.update');
    Route::put('/admin/about/identity', [AdminController::class, 'updateSiteIdentity'])->name('admin.about.identity.update');
    
    // About Boxes text edit
    Route::get('/admin/about/boxes/{id}/edit', [AdminController::class, 'editAboutBox'])->name('admin.about.box.edit');
    Route::put('/admin/about/boxes/{id}', [AdminController::class, 'updateAboutBox'])->name('admin.about.box.update');

    // Expertise CRUD
    Route::get('/admin/about/expertise/create', [AdminController::class, 'createExpertise'])->name('admin.about.expertise.create');
    Route::post('/admin/about/expertise', [AdminController::class, 'storeExpertise'])->name('admin.about.expertise.store');
    Route::get('/admin/about/expertise/{id}/edit', [AdminController::class, 'editExpertise'])->name('admin.about.expertise.edit');
    Route::put('/admin/about/expertise/{id}', [AdminController::class, 'updateExpertise'])->name('admin.about.expertise.update');
    Route::delete('/admin/about/expertise/{id}', [AdminController::class, 'deleteExpertise'])->name('admin.about.expertise.delete');

    // Breeze default profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Vercel Database Migration Helper
Route::get('/vercel-migrate', function (\Illuminate\Http\Request $request) {
    if ($request->query('key') !== env('MIGRATE_KEY')) {
        abort(403, 'Unauthorized');
    }

    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', [
            '--force' => true,
        ]);
        $output = \Illuminate\Support\Facades\Artisan::output();
        return response($output, 200)
            ->header('Content-Type', 'text/plain');
    } catch (\Exception $e) {
        return response("Migration failed:\n" . $e->getMessage(), 500)
            ->header('Content-Type', 'text/plain');
    }
});

require __DIR__.'/auth.php';