<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

$app = Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->report(function (\Throwable $e) {
            error_log("LARAVEL_EXCEPTION: " . $e->getMessage() . "\n" . $e->getTraceAsString());
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
