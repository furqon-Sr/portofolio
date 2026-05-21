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
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (\Throwable $e) {
            header('Content-Type: text/plain', true, 500);
            echo "Original exception: " . get_class($e) . ": " . $e->getMessage() . "\n";
            echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
            echo "Trace:\n" . $e->getTraceAsString() . "\n";
            if ($e->getPrevious()) {
                echo "\nPrevious Exception: " . get_class($e->getPrevious()) . ": " . $e->getPrevious()->getMessage() . "\n";
                echo "File: " . $e->getPrevious()->getFile() . ":" . $e->getPrevious()->getLine() . "\n";
                echo "Trace:\n" . $e->getPrevious()->getTraceAsString() . "\n";
            }
            exit;
        });
    })->create();

if (getenv('VERCEL') || isset($_SERVER['VERCEL']) || getenv('NOW_PORT') || isset($_SERVER['NOW_PORT'])) {
    $storagePath = '/tmp/storage';
    $app->useStoragePath($storagePath);

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
    ];

    foreach ($directories as $directory) {
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }
    }
}

return $app;
