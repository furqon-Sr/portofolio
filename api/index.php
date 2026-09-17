<?php

$host = $_SERVER['HTTP_X_FORWARDED_HOST'] ?? $_SERVER['HTTP_HOST'] ?? '';
if (str_contains(strtolower($host), 'vercel.app')) {
    $uri = $_SERVER['REQUEST_URI'] ?? '/';
    header('Location: https://fahrurihanafi.site' . $uri, true, 301);
    exit;
}

$_SERVER['SCRIPT_NAME'] = '/index.php';

require __DIR__ . '/../public/index.php';