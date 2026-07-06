<?php
declare(strict_types=1);

$config = require_once __DIR__ . '/config.php';

try {
    $dsn = sprintf(
        "mysql:host=%s;dbname=%s;charset=%s",
        $config['host'],
        $config['dbname'],
        $config['charset']
    );
    $db = new PDO($dsn, $config['username'], $config['password']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
} catch (PDOException $e) {
    error_log("Database connection error: " . $e->getMessage());
    exit("A database connection error occurred. Please try again later.");
}
