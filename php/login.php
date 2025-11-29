<?php
session_start();
require '../php/db_connect.php';

$data = $_POST;

if(isset($data['email'], $data['password'])){
    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$data['email']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user && password_verify($data['password'], $user['password'])){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['name'] = $user['first_name'];

        echo json_encode(['success'=>true,'role'=>$user['role'],'user_id'=>$user['id']]);
    } else {
        echo json_encode(['success'=>false]);
    }
} else {
    echo json_encode(['success'=>false]);
}
?>
