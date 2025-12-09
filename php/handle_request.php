<?php
// php/handle_request.php
header('Content-Type: application/json; charset=utf-8');
require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/auth_check.php';
require_once __DIR__ . '/role_check.php';
require_role('faculty');

$body = json_decode(file_get_contents('php://input'), true);
$request_id = (int)($body['request_id'] ?? 0);
$action = $body['action'] ?? ''; // 'approve' or 'reject'

if (!$request_id || !in_array($action, ['approve','reject'])) {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
    exit;
}

try {
    // find request and ensure the faculty owns the course
    $stmt = $pdo->prepare("SELECT jr.*, c.faculty_id FROM join_requests jr JOIN courses c ON c.id = jr.course_id WHERE jr.id = :id LIMIT 1");
    $stmt->execute(['id' => $request_id]);
    $req = $stmt->fetch();
    if (!$req || $req['faculty_id'] != $_SESSION['user_id']) {
        echo json_encode(['success' => false, 'message' => 'Unauthorized']);
        exit;
    }

    $status = $action === 'approve' ? 'approved' : 'rejected';
    $pdo->beginTransaction();

    $update = $pdo->prepare("UPDATE join_requests SET status = :status WHERE id = :id");
    $update->execute(['status' => $status, 'id' => $request_id]);

    if ($action === 'approve') {
        // add to enrollments if not already enrolled
        $check = $pdo->prepare("SELECT id FROM enrollments WHERE course_id = :course_id AND student_id = :student_id LIMIT 1");
        $check->execute(['course_id' => $req['course_id'], 'student_id' => $req['student_id']]);
        if (!$check->fetch()) {
            $ins = $pdo->prepare("INSERT INTO enrollments (course_id, student_id, enrolled_at) VALUES (:course_id, :student_id, NOW())");
            $ins->execute(['course_id' => $req['course_id'], 'student_id' => $req['student_id']]);
        }
    }

    $pdo->commit();
    echo json_encode(['success' => true]);
} catch (Exception $e) {
    if ($pdo->inTransaction()) $pdo->rollBack();
    echo json_encode(['success' => false]);
}
