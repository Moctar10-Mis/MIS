<?php
// php/faculty_requests.php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/auth_check.php';
require_once __DIR__ . '/role_check.php';
require_role('faculty');

try {
    $stmt = $pdo->prepare("SELECT jr.id, jr.course_id, jr.student_id, jr.status, jr.requested_at, u.username as student_name, c.title as course_title
                           FROM join_requests jr
                           JOIN users u ON u.id = jr.student_id
                           JOIN courses c ON c.id = jr.course_id
                           WHERE c.faculty_id = :faculty_id
                           ORDER BY jr.requested_at DESC");
    $stmt->execute(['faculty_id' => $_SESSION['user_id']]);
    echo json_encode(['success' => true, 'requests' => $stmt->fetchAll()]);
} catch (Exception $e) {
    echo json_encode(['success' => false]);
}

