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

// Attach Vercel Edge Cache headers and strip Set-Cookie on public read-only pages
$path = '/' . ltrim($request->path(), '/');
$isPublicCacheable = $request->isMethodSafe() && $response->isSuccessful() && (
    $path === '/' || 
    str_starts_with($path, '/works') || 
    str_starts_with($path, '/certificates') || 
    str_starts_with($path, '/blog') || 
    str_starts_with($path, '/media')
);

if ($isPublicCacheable) {
    $sMaxAge = str_starts_with($path, '/media') ? 86400 : 3600;
    $response->headers->set('Cache-Control', "public, max-age=0, s-maxage={$sMaxAge}, stale-while-revalidate=86400");
    foreach ($response->headers->getCookies() as $cookie) {
        $response->headers->removeCookie($cookie->getName(), $cookie->getPath(), $cookie->getDomain());
    }
    $response->headers->remove('Set-Cookie');
    header_remove('Set-Cookie');
}

$response->send();
if ($isPublicCacheable) {
    header_remove('Set-Cookie');
}
$kernel->terminate($request, $response);
