<?php
header('Content-Type: application/json; charset=utf-8');
session_start();
if (!empty($_SESSION['user_id'])) {
    echo json_encode(['logged_in' => true, 'username' => $_SESSION['username'], 'role' => $_SESSION['role']]);
} else {
    echo json_encode(['logged_in' => false]);
}
