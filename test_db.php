<?php
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

try {
    $pdo = new PDO(
        "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}",
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD']
    );
    echo "✅ Connected successfully to {$_ENV['DB_DATABASE']} as {$_ENV['DB_USERNAME']}";
} catch (PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
