<?php
require_once __DIR__ . '/db_connect.php';
require_once __DIR__ . '/auth_check.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $stmt = $pdo->prepare("UPDATE users SET username = :u, email = :e WHERE id = :id");
    $stmt->execute(['u'=>$username,'e'=>$email,'id'=>$_SESSION['user_id']]);
}
header('Location: /HTML/profile.php');
