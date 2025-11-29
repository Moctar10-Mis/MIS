<?php
// php/db_connect.php
// PDO connection reading .env file (simple parser)
// Make sure .env is in project root (one level up)

$env = [];
$envPath = __DIR__ . '/../.env';
if (file_exists($envPath)) {
    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        $parts = explode('=', $line, 2);
        if (count($parts) === 2) {
            $env[trim($parts[0])] = trim($parts[1]);
        }
    }
}

function env($key, $default = '') {
    global $env;
    if (getenv($key) !== false) return getenv($key);
    if (isset($env[$key])) return $env[$key];
    return $default;
}

$DB_HOST = env('DB_HOST', 'localhost');
$DB_NAME = env('DB_NAME', 'attendance_db');
$DB_USER = env('DB_USER', 'root');
$DB_PASS = env('DB_PASS', '');

$dsn = "mysql:host={$DB_HOST};dbname={$DB_NAME};charset=utf8mb4";
try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    // In production, log this instead of echoing
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection error']);
    exit;
}

