<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/contact', function () {
    return view('contact'); 
})->name('contact.show');
Route::get('/works', function () {
    return view('works'); 
})->name('works.show');

// Memproses pengiriman form kontak
Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.store');


// PROTECTED ROUTES 
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profil bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Halaman Admin Inbox Pesan
    Route::get('/admin/messages', [ContactController::class, 'index'])->name('admin.messages');
});

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