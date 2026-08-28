<?php
require 'vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

// We need to bypass CSRF and Auth for this quick test.
// I will just instantiate the controller and call the method directly.

$controller = new \App\Http\Controllers\Admin\AdminController();
$request = Illuminate\Http\Request::create('/admin/clients/1', 'PUT', [
    'name' => 'Acme Corp Updated',
    'url' => 'https://acme.com',
    'order_index' => 1,
    'logo' => 'data:image/svg+xml;base64,PHN2Zz48L3N2Zz4=' // dummy svg
]);
$request->setRouteResolver(function () use ($request) {
    $route = new Illuminate\Routing\Route('PUT', '/admin/clients/{id}', []);
    $route->bind($request);
    $route->setParameter('id', '1');
    return $route;
});

try {
    $response = $controller->updateClient($request, 1);
    echo "Status: " . $response->getStatusCode() . "\n";
} catch (\Exception $e) {
    echo "Exception: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
} catch (\Error $e) {
    echo "Error: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n";
}
