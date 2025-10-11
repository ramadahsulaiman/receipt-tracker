<?php

$driver = $_ENV['DB_DRIVER'] ?? 'mysql';

if ($driver === 'pgsql') {
    // Supabase (Postgres)
    return [
        'class' => 'yii\db\Connection',
        'dsn' => "pgsql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}",
        'username' => $_ENV['DB_USERNAME'],
        'password' => $_ENV['DB_PASSWORD'] ?? NULL,
        'charset' => 'utf8',
    ];
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_DATABASE']}",
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'] ?? NULL,
    'charset' => 'utf8mb4',
];
