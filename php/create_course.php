<?php
// php/create_course.php
header('Content-Type: application/json; charset=utf-8');
require_once ('db_connect.php');
require_once ('auth_check.php');
require_once ('role_check.php');
require_role('faculty');

$body = json_decode(file_get_contents('php://input'), true);
$title = trim($body['title'] ?? '');
$code = trim($body['code'] ?? '');

if (!$title || !$code) {
    echo json_encode(['success' => false, 'message' => 'Missing fields']);
    exit;
}

try {
    $stmt = $pdo->prepare("INSERT INTO courses (title, code, faculty_id, created_at) VALUES (:title, :code, :faculty_id, NOW())");
    $stmt->execute(['title' => $title, 'code' => $code, 'faculty_id' => $_SESSION['user_id']]);
    echo json_encode(['success' => true, 'course_id' => (int)$pdo->lastInsertId()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error']);
}

