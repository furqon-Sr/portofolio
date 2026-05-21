<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Bootstrap Laravel and handle the request...
try {
    /** @var Application $app */
    $app = require __DIR__.'/../bootstrap/app.php';

    if (is_bool($app)) {
        header('Content-Type: text/plain');
        echo "Error: bootstrap/app.php returned a boolean: " . ($app ? 'true' : 'false') . "\n";
        exit;
    }

    if (!$app instanceof \Illuminate\Contracts\Container\Container) {
        header('Content-Type: text/plain');
        echo "Error: \$app is not a Laravel container. Got class: " . (is_object($app) ? get_class($app) : gettype($app)) . "\n";
        exit;
    }

    if (!$app->bound(\Illuminate\Contracts\Http\Kernel::class)) {
        header('Content-Type: text/plain');
        echo "Error: Illuminate\\Contracts\\Http\\Kernel is NOT bound in the container.\n";
        echo "Registered bindings:\n";
        print_r(array_keys($app->getBindings()));
        exit;
    }

    $app->handleRequest(Request::capture());
} catch (\Throwable $e) {
    header('Content-Type: text/plain', true, 500);
    echo "Caught exception: " . get_class($e) . ": " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . ":" . $e->getLine() . "\n";
    echo "Trace:\n" . $e->getTraceAsString() . "\n";
    if ($e->getPrevious()) {
        echo "\nPrevious Exception: " . get_class($e->getPrevious()) . ": " . $e->getPrevious()->getMessage() . "\n";
        echo "File: " . $e->getPrevious()->getFile() . ":" . $e->getPrevious()->getLine() . "\n";
        echo "Trace:\n" . $e->getPrevious()->getTraceAsString() . "\n";
    }
    exit;
}
