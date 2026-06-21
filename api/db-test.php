<?php
header('Content-Type: text/plain');

$host = getenv('DB_HOST');
$db   = getenv('DB_DATABASE');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$port = getenv('DB_PORT') ?: '5432';
$sslmode = getenv('DB_SSLMODE') ?: 'require';

echo "Environment Variables Loaded:\n";
echo "DB_HOST: " . ($host ?: 'NOT SET') . "\n";
echo "DB_DATABASE: " . ($db ?: 'NOT SET') . "\n";
echo "DB_USERNAME: " . ($user ?: 'NOT SET') . "\n";
echo "DB_PASSWORD length: " . strlen($pass) . "\n";
echo "DB_PORT: $port\n";
echo "DB_SSLMODE: $sslmode\n\n";

$dsn = "pgsql:host=$host;port=$port;dbname=$db;sslmode=$sslmode";

try {
    echo "Connecting to DSN: pgsql:host=$host;port=$port;dbname=$db;sslmode=$sslmode...\n";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_EMULATE_PREPARES => true,
    ]);
    echo "Connection successful!\n";
    
    $stmt = $pdo->query("SELECT VERSION()");
    echo "PostgreSQL Version: " . $stmt->fetchColumn() . "\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
