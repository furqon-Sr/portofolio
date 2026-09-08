<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AdminController;
use App\Models\Project;

// Secret Admin Path (default: console-fh927, customizable via ADMIN_SECRET_PATH in .env)
$adminPath = env('ADMIN_SECRET_PATH', 'console-fh927');

// Honeypot & Scanner Redirects: send any direct attempt to access admin/login straight to home
Route::any('/admin', fn () => redirect('/'));
Route::any('/admin/{any}', fn () => redirect('/'))->where('any', '.*');
Route::any('/dashboard', fn () => redirect('/'));
Route::any('/wp-login.php', fn () => redirect('/'));
Route::any('/wp-admin', fn () => redirect('/'));
Route::any('/wp-admin/{any}', fn () => redirect('/'))->where('any', '.*');

// Home Page - Cached at Vercel Edge CDN for 3600s
Route::get('/', function () {
    $projects = Project::orderBy('id', 'asc')->get();
    $aboutText = \App\Models\AboutSetting::first()->about_text ?? '';
    $aboutBoxes = \App\Models\AboutBox::orderBy('id', 'asc')->get();
    $expertises = \App\Models\Expertise::orderBy('id', 'asc')->get();
    $certificates = \App\Models\Certificate::orderBy('id', 'desc')->get();
    $clients = \App\Models\Client::orderBy('order_index', 'asc')->get();
    $latestArticles = \App\Models\Article::orderBy('created_at', 'desc')->take(3)->get();

    return view('welcome', compact('projects', 'aboutText', 'aboutBoxes', 'expertises', 'certificates', 'clients', 'latestArticles'));
})->middleware('edge.cache:3600');

// Works Page - Cached at Vercel Edge CDN for 3600s
Route::get('/works', function () {
    $projects = Project::orderBy('id', 'asc')->get();
    return view('works', compact('projects'));
})->name('works.show')->middleware('edge.cache:3600');

// Certificates Page - Cached at Vercel Edge CDN for 3600s
Route::get('/certificates', function () {
    $certificates = \App\Models\Certificate::orderBy('id', 'desc')->get();
    return view('certificates', compact('certificates'));
})->name('certificates.show')->middleware('edge.cache:3600');

// Blog Page - Cached at Vercel Edge CDN for 3600s
Route::get('/blog', function () {
    $articles = \App\Models\Article::orderBy('id', 'desc')->get();
    return view('blog', compact('articles'));
})->name('blog.index')->middleware('edge.cache:3600');

Route::get('/blog/{slug}', function ($slug) {
    $article = \App\Models\Article::where('slug', $slug)->firstOrFail();
    return view('blog-show', compact('article'));
})->name('blog.show')->middleware('edge.cache:3600');

// Contact Page (Interactive form: not edge cached to ensure dynamic CSRF tokens)
Route::get('/contact', function () {
    return view('contact'); 
})->name('contact.show');

// Contact Form Submit with Rate Limiting (max 5 requests per minute)
Route::post('/contact-submit', [ContactController::class, 'store'])
    ->middleware('throttle:5,1')
    ->name('contact.store');

// Download or View Active CV
Route::get('/cv', [AdminController::class, 'downloadCv'])->name('cv.download');

// PROTECTED ADMIN ROUTES (Under the secret path)
Route::prefix($adminPath)->middleware(['auth', 'verified'])->group(function () {
    
    // Redirect /$adminPath to dashboard
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });

    // Admin Panel Actions
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
    
    // Admin Project CRUD
    Route::get('/projects', [AdminController::class, 'projects'])->name('admin.projects.index');
    Route::get('/projects/create', [AdminController::class, 'createProject'])->name('admin.projects.create');
    Route::post('/projects', [AdminController::class, 'storeProject'])->name('admin.projects.store');
    Route::get('/projects/{id}/edit', [AdminController::class, 'editProject'])->name('admin.projects.edit');
    Route::put('/projects/{id}', [AdminController::class, 'updateProject'])->name('admin.projects.update');
    Route::delete('/projects/{id}', [AdminController::class, 'deleteProject'])->name('admin.projects.delete');

    // Admin Certificate CRUD
    Route::get('/certificates', [AdminController::class, 'certificates'])->name('admin.certificates.index');
    Route::get('/certificates/create', [AdminController::class, 'createCertificate'])->name('admin.certificates.create');
    Route::post('/certificates', [AdminController::class, 'storeCertificate'])->name('admin.certificates.store');
    Route::get('/certificates/{id}/edit', [AdminController::class, 'editCertificate'])->name('admin.certificates.edit');
    Route::put('/certificates/{id}', [AdminController::class, 'updateCertificate'])->name('admin.certificates.update');
    Route::delete('/certificates/{id}', [AdminController::class, 'deleteCertificate'])->name('admin.certificates.delete');

    // Admin Blog / Articles CRUD
    Route::get('/articles', [AdminController::class, 'articles'])->name('admin.articles.index');
    Route::get('/articles/create', [AdminController::class, 'createArticle'])->name('admin.articles.create');
    Route::post('/articles', [AdminController::class, 'storeArticle'])->name('admin.articles.store');
    Route::get('/articles/{id}/edit', [AdminController::class, 'editArticle'])->name('admin.articles.edit');
    Route::put('/articles/{id}', [AdminController::class, 'updateArticle'])->name('admin.articles.update');
    Route::delete('/articles/{id}', [AdminController::class, 'deleteArticle'])->name('admin.articles.delete');

    // Admin About Me & Expertise Section CRUD
    Route::get('/about', [AdminController::class, 'about'])->name('admin.about');
    Route::put('/about/text', [AdminController::class, 'updateAboutText'])->name('admin.about.text.update');
    Route::put('/about/identity', [AdminController::class, 'updateSiteIdentity'])->name('admin.about.identity.update');
    Route::put('/about/hero', [AdminController::class, 'updateHeroText'])->name('admin.about.hero.update');
    
    // About Boxes text edit
    Route::get('/about/boxes/{id}/edit', [AdminController::class, 'editAboutBox'])->name('admin.about.box.edit');
    Route::put('/about/boxes/{id}', [AdminController::class, 'updateAboutBox'])->name('admin.about.box.update');

    // Expertise CRUD
    Route::get('/about/expertise/create', [AdminController::class, 'createExpertise'])->name('admin.about.expertise.create');
    Route::post('/about/expertise', [AdminController::class, 'storeExpertise'])->name('admin.about.expertise.store');
    Route::get('/about/expertise/{id}/edit', [AdminController::class, 'editExpertise'])->name('admin.about.expertise.edit');
    Route::put('/about/expertise/{id}', [AdminController::class, 'updateExpertise'])->name('admin.about.expertise.update');
    Route::delete('/about/expertise/{id}', [AdminController::class, 'deleteExpertise'])->name('admin.about.expertise.delete');

    // Admin Clients CRUD
    Route::get('/clients', [AdminController::class, 'clients'])->name('admin.clients.index');
    Route::get('/clients/create', [AdminController::class, 'createClient'])->name('admin.clients.create');
    Route::post('/clients', [AdminController::class, 'storeClient'])->name('admin.clients.store');
    Route::get('/clients/{id}/edit', [AdminController::class, 'editClient'])->name('admin.clients.edit');
    Route::put('/clients/{id}', [AdminController::class, 'updateClient'])->name('admin.clients.update');
    Route::delete('/clients/{id}', [AdminController::class, 'deleteClient'])->name('admin.clients.delete');

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
        
        $output .= "\n--- Running Database Image Optimization ---\n";
        
        // Optimize Projects
        $projects = \App\Models\Project::all();
        $projectCount = 0;
        foreach ($projects as $project) {
            $original = $project->cover_image;
            $compressed = \App\Http\Controllers\Admin\AdminController::compressBase64Image($original);
            if ($original !== $compressed) {
                $project->update(['cover_image' => $compressed]);
                $projectCount++;
            }
        }
        $output .= "Compressed {$projectCount} project cover images.\n";
        
        // Optimize Certificates
        $certificates = \App\Models\Certificate::all();
        $certificateCount = 0;
        foreach ($certificates as $certificate) {
            $original = $certificate->image;
            $compressed = \App\Http\Controllers\Admin\AdminController::compressBase64Image($original);
            if ($original !== $compressed) {
                $certificate->update(['image' => $compressed]);
                $certificateCount++;
            }
        }
        $output .= "Compressed {$certificateCount} certificate images.\n";
        $output .= "--- Optimization Complete ---\n";

        return response($output, 200)
            ->header('Content-Type', 'text/plain');
    } catch (\Exception $e) {
        return response("Migration/Optimization failed:\n" . $e->getMessage(), 500)
            ->header('Content-Type', 'text/plain');
    }
});

// API route for incrementing project views
Route::post('/api/projects/{id}/view', function ($id) {
    $project = \App\Models\Project::find($id);
    if ($project) {
        $project->increment('views');
        return response()->json(['success' => true, 'views' => $project->views]);
    }
    return response()->json(['success' => false], 404);
})->middleware('throttle:30,1');

require __DIR__.'/auth.php';
