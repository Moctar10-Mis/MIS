
<?php

session_start();
session_destroy();
header("Location: WELCOME.php");
exit();

// php/logout.php
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['logout' => false, 'message' => 'Method not allowed']);
    exit;
}


session_start();
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $p = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
}
$destroyed = session_destroy();
echo json_encode(['logout' => (bool)$destroyed]);


