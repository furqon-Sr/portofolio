<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$request = Illuminate\Http\Request::create('/admin/clients/1', 'PUT', [
    'name' => 'Test',
    'url' => 'https://test.com',
    'order_index' => 1,
    'logo' => 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAQAAAC1HAwCAAAAC0lEQVR42mNkYAAAAAYAAjCB0C8AAAAASUVORK5CYII='
]);
$response = app()->handle($request);
echo $response->getStatusCode() . "\n";
echo $response->getContent();
