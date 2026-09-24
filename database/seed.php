<?php

require_once __DIR__ . '/../app/core/Database.php';

$db = Database::connect();

$db->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )
");

$db->exec("DELETE FROM users");
$db->exec("DELETE FROM sqlite_sequence WHERE name='users'");

$users = [
    ['Juan Pérez', 'juan@example.com'],
    ['María López', 'maria@example.com'],
    ['Carlos Ramírez', 'carlos@example.com'],
    ['Ana Torres', 'ana@example.com'],
    ['Luis Gómez', 'luis@example.com'],
];

$stmt = $db->prepare('INSERT INTO users(name, email, password, created_at) VALUES (?,?,?,?)');

foreach ($users as [$name, $email]) {
    $stmt->execute([
        $name,
        $email,
        password_hash('password123', PASSWORD_DEFAULT),
        date('Y-m-d H:i:s'),
    ]);
}

echo "Base de datos inicializada con " . count($users) . " usuarios.\n";