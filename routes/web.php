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

// Home Page - Rendered fresh from database
Route::get('/', function () {
    $projects = Project::select('id', 'title', 'slug', 'category', 'description', 'live_link', 'cover_image', 'github_link', 'views', 'updated_at')
        ->selectRaw('(design_file IS NOT NULL) as has_design_file')
        ->orderBy('id', 'asc')
        ->get();
    $aboutBoxes = \App\Models\AboutBox::orderBy('id', 'asc')->get();
    $expertises = \App\Models\Expertise::orderBy('id', 'asc')->get();
    $certificates = \App\Models\Certificate::orderBy('id', 'desc')->get();
    $clients = \App\Models\Client::orderBy('order_index', 'asc')->get();
    $latestArticles = \App\Models\Article::orderBy('created_at', 'desc')->take(3)->get();

    return view('welcome', compact('projects', 'aboutBoxes', 'expertises', 'certificates', 'clients', 'latestArticles'));
});

// Works Page - Rendered fresh from database
Route::get('/works', function () {
    $projects = Project::select('id', 'title', 'slug', 'category', 'description', 'live_link', 'cover_image', 'github_link', 'views', 'updated_at')
        ->selectRaw('(design_file IS NOT NULL) as has_design_file')
        ->orderBy('id', 'asc')
        ->get();
    return view('works', compact('projects'));
})->name('works.show');

// Certificates Page - Rendered fresh from database
Route::get('/certificates', function () {
    $certificates = \App\Models\Certificate::orderBy('id', 'desc')->get();
    return view('certificates', compact('certificates'));
})->name('certificates.show');

// Optimized Binary Media Delivery (cached permanently at Edge CDN)
Route::get('/media/profile-photo', function () {
    $setting = \App\Models\AboutSetting::first();
    if (!$setting || empty($setting->profile_photo)) {
        return redirect(asset('img/porto.png'));
    }

    $photo = $setting->profile_photo;
    if (str_starts_with($photo, 'data:image/')) {
        [$meta, $data] = explode(',', $photo, 2);
        preg_match('#data:image/([a-zA-Z0-9\+\.-]+);base64#', $meta, $matches);
        $mime = 'image/' . ($matches[1] ?? 'jpeg');
        return response(base64_decode($data), 200, [
            'Content-Type' => $mime,
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }

    if (str_starts_with($photo, 'http')) {
        return redirect($photo);
    }

    return redirect(asset('img/' . ltrim($photo, '/')));
})->name('media.profile')->middleware('edge.cache:86400');

Route::get('/media/certificates/{id}', function ($id) {
    $cert = \App\Models\Certificate::find($id);
    if (!$cert || empty($cert->image)) {
        return redirect(asset('favicon.ico'));
    }

    $image = $cert->image;
    if (str_starts_with($image, 'data:application/pdf')) {
        [, $data] = explode(',', $image, 2);
        return response(base64_decode($data), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="certificate-' . $cert->id . '.pdf"',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }

    if (str_starts_with($image, 'data:image/')) {
        [$meta, $data] = explode(',', $image, 2);
        preg_match('#data:image/([a-zA-Z0-9\+\.-]+);base64#', $meta, $matches);
        $mime = 'image/' . ($matches[1] ?? 'jpeg');
        return response(base64_decode($data), 200, [
            'Content-Type' => $mime,
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }

    if (str_starts_with($image, 'http')) {
        return redirect($image);
    }

    return redirect(asset('img/certificates/' . ltrim($image, '/')));
})->name('media.certificate')->middleware('edge.cache:86400');

// Project Design PDF Stream Route
Route::get('/media/projects/{id}/design', function ($id) {
    $project = \App\Models\Project::findOrFail($id);
    $file = $project->design_file;
    if (!$file) {
        abort(404, 'No design document found.');
    }

    if (str_starts_with($file, 'data:application/pdf')) {
        [, $data] = explode(',', $file, 2);
        return response(base64_decode($data), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="design-' . Str::slug($project->title) . '.pdf"',
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }

    if (str_starts_with($file, 'http')) {
        return redirect($file);
    }

    return redirect(asset('storage/' . ltrim($file, '/')));
})->name('media.project.design')->middleware('edge.cache:86400');

// Project Cover Image Stream Route
Route::get('/media/projects/{id}/cover', function ($id) {
    $project = \App\Models\Project::findOrFail($id);
    $image = $project->cover_image;
    if (!$image) {
        return redirect(asset('img/porto.png'));
    }

    if (str_starts_with($image, 'data:image/')) {
        [$meta, $data] = explode(',', $image, 2);
        preg_match('#data:image/([a-zA-Z0-9\+\.-]+);base64#', $meta, $matches);
        $mime = 'image/' . ($matches[1] ?? 'jpeg');
        return response(base64_decode($data), 200, [
            'Content-Type' => $mime,
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
            'Cache-Control' => 'public, max-age=31536000, immutable',
        ]);
    }

    if (str_starts_with($image, 'http')) {
        return redirect($image);
    }

    return redirect(asset('img/' . ltrim($image, '/')));
})->name('media.project.cover')->middleware('edge.cache:86400');

// Blog Page - Rendered fresh from database
Route::get('/blog', function () {
    $articles = \App\Models\Article::orderBy('id', 'desc')->get();
    return view('blog', compact('articles'));
})->name('blog.index');

Route::get('/blog/{slug}', function ($slug) {
    $article = \App\Models\Article::where('slug', $slug)->firstOrFail();
    return view('blog-show', compact('article'));
})->name('blog.show');

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
    Route::delete('/messages/{id}', [AdminController::class, 'deleteMessage'])->name('admin.messages.delete');
    Route::delete('/messages-clear-all', [AdminController::class, 'clearAllMessages'])->name('admin.messages.clearAll');
    
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

// API route for incrementing project views (supports both local and Vercel pathing)
$incrementProjectViews = function ($id) {
    $project = \App\Models\Project::find($id);
    if ($project) {
        $project->increment('views');
        return response()->json(['success' => true, 'views' => $project->views]);
    }
    return response()->json(['success' => false], 404);
};

Route::post('/api/projects/{id}/view', $incrementProjectViews)->middleware('throttle:60,1');
Route::post('/projects/{id}/view', $incrementProjectViews)->middleware('throttle:60,1');

require __DIR__.'/auth.php';
