<?php
$dsn = 'pgsql:host=db;port=5432;dbname=courier_schedule';
$user = 'user';
$password = 'password';

try {
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Error connecting to database: " . $e->getMessage());
}
