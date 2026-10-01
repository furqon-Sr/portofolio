<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->redirectGuestsTo(fn () => '/');
        $middleware->redirectUsersTo(fn () => route('admin.dashboard'));
        $middleware->alias([
            'edge.cache' => \App\Http\Middleware\EdgeCache::class,
            'api.key' => \App\Http\Middleware\ApiKeyMiddleware::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'api/*',
            'projects/*/view',
            '*upload-chunk*',
            '*upload-combine*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (\Illuminate\Validation\ValidationException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validasi gagal: ' . $e->getMessage(),
                    'data' => $e->errors(),
                ], 422);
            }
        });
        $exceptions->render(function (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Resource atau endpoint tidak ditemukan.',
                    'data' => null,
                ], 404);
            }
        });
        $exceptions->render(function (\Throwable $e, \Illuminate\Http\Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'status' => 'error',
                    'message' => $e->getMessage(),
                    'data' => null,
                ], 500);
            }
        });
    })->create();

if (getenv('VERCEL') || isset($_SERVER['VERCEL']) || getenv('NOW_PORT') || isset($_SERVER['NOW_PORT'])) {
    $storagePath = '/tmp/storage';
    $app->useStoragePath($storagePath);

    $bootstrapCachePath = '/tmp/storage/bootstrap/cache';
    
    $_ENV['APP_SERVICES_CACHE'] = $bootstrapCachePath . '/services.php';
    $_ENV['APP_PACKAGES_CACHE'] = $bootstrapCachePath . '/packages.php';
    $_ENV['APP_CONFIG_CACHE'] = $bootstrapCachePath . '/config.php';
    $_ENV['APP_ROUTES_CACHE'] = $bootstrapCachePath . '/routes.php';
    $_ENV['APP_EVENTS_CACHE'] = $bootstrapCachePath . '/events.php';
    
    putenv("APP_SERVICES_CACHE={$bootstrapCachePath}/services.php");
    putenv("APP_PACKAGES_CACHE={$bootstrapCachePath}/packages.php");
    putenv("APP_CONFIG_CACHE={$bootstrapCachePath}/config.php");
    putenv("APP_ROUTES_CACHE={$bootstrapCachePath}/routes.php");
    putenv("APP_EVENTS_CACHE={$bootstrapCachePath}/events.php");
    
    $_SERVER['APP_SERVICES_CACHE'] = $bootstrapCachePath . '/services.php';
    $_SERVER['APP_PACKAGES_CACHE'] = $bootstrapCachePath . '/packages.php';
    $_SERVER['APP_CONFIG_CACHE'] = $bootstrapCachePath . '/config.php';
    $_SERVER['APP_ROUTES_CACHE'] = $bootstrapCachePath . '/routes.php';
    $_SERVER['APP_EVENTS_CACHE'] = $bootstrapCachePath . '/events.php';

    $directories = [
        $storagePath,
        $storagePath . '/app',
        $storagePath . '/app/public',
        $storagePath . '/framework',
        $storagePath . '/framework/cache',
        $storagePath . '/framework/cache/data',
        $storagePath . '/framework/sessions',
        $storagePath . '/framework/views',
        $storagePath . '/logs',
        '/tmp/storage/bootstrap',
        $bootstrapCachePath,
    ];

    foreach ($directories as $directory) {
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}

return $app;
