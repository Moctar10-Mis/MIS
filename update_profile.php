<?php
require_once ('php/db_connect.php');
require_once ('php/auth_check.php');
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $stmt = $pdo->prepare("UPDATE users SET username = :u, email = :e WHERE id = :id");
    $stmt->execute(['u'=>$username,'e'=>$email,'id'=>$_SESSION['user_id']]);
}
header('Location: profile.php');
