
<?php
// php/signup.php
header('Content-Type: application/json; charset=utf-8');
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

require_once __DIR__ . '/db_connect.php';

$body = json_decode(file_get_contents('php://input'), true);
$username = trim($body['username'] ?? '');
$email = trim($body['email'] ?? '');
$password = $body['password'] ?? '';
$role = $body['role'] ?? 'student';

if (!$username || !$email || !$password) {
    echo json_encode(['success' => false, 'message' => 'Missing fields']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email']);
    exit;
}

try {
    // check duplicate username or email
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email LIMIT 1");
    $stmt->execute(['username' => $username, 'email' => $email]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'User exists']);
        exit;
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, role, created_at) VALUES (:username, :email, :password_hash, :role, NOW())");
    $stmt->execute([
        'username' => $username,
        'email' => $email,
        'password_hash' => $hash,
        'role' => $role
    ]);

    $id = (int)$pdo->lastInsertId();
    echo json_encode(['success' => true, 'user_id' => $id, 'username' => $username]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error']);
}

