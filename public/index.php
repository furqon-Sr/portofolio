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
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);
$request = Request::capture();
$response = $kernel->handle($request);

// Cache media files at edge, but serve HTML pages fresh so admin changes reflect immediately
$path = '/' . ltrim($request->path(), '/');
$isMediaRoute = str_starts_with($path, '/media') && $request->isMethodSafe() && $response->isSuccessful();

if ($isMediaRoute) {
    $response->headers->set('Cache-Control', "public, max-age=0, s-maxage=86400, stale-while-revalidate=86400");
    foreach ($response->headers->getCookies() as $cookie) {
        $response->headers->removeCookie($cookie->getName(), $cookie->getPath(), $cookie->getDomain());
    }
    $response->headers->remove('Set-Cookie');
    header_remove('Set-Cookie');
} else {
    // HTML pages: ensure browser and Vercel edge never cache stale versions of content
    $response->headers->set('Cache-Control', 'no-cache, private, must-revalidate');
}

$response->send();
if ($isMediaRoute) {
    header_remove('Set-Cookie');
}
$kernel->terminate($request, $response);
