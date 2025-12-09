<?php
// php/request_join.php
header('Content-Type: application/json; charset=utf-8');
require_once ('db_connect.php');
require_once ('auth_check.php');
require_once ('role_check.php');
require_role('student');

$body = json_decode(file_get_contents('php://input'), true);
$course_id = (int)($body['course_id'] ?? 0);
$student_id = $_SESSION['user_id'];

if (!$course_id) {
    echo json_encode(['success' => false, 'message' => 'Missing course id']);
    exit;
}

try {
    // prevent duplicate requests
    $stmt = $pdo->prepare("SELECT id FROM join_requests WHERE course_id = :course_id AND student_id = :student_id LIMIT 1");
    $stmt->execute(['course_id' => $course_id, 'student_id' => $student_id]);
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'Already requested']);
        exit;
    }
    $stmt = $pdo->prepare("INSERT INTO join_requests (course_id, student_id, status, requested_at) VALUES (:course_id, :student_id, 'pending', NOW())");
    $stmt->execute(['course_id' => $course_id, 'student_id' => $student_id]);
    echo json_encode(['success' => true, 'request_id' => (int)$pdo->lastInsertId()]);
} catch (Exception $e) {
    echo json_encode(['success' => false]);
}
