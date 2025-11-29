<?php
// php/list_courses.php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/auth_check.php';

try {
    $stmt = $pdo->query("SELECT c.id, c.title, c.code, c.faculty_id, u.username as faculty_name FROM courses c JOIN users u ON u.id = c.faculty_id ORDER BY c.title");
    $rows = $stmt->fetchAll();
    echo json_encode(['success' => true, 'courses' => $rows]);
} catch (Exception $e) {
    echo json_encode(['success' => false]);
}
