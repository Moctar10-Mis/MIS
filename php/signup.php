<?php
require '../php/db_connect.php';

$data = $_POST;

if(isset($data['first_name'], $data['last_name'], $data['email'], $data['password'], $data['role'])){
 // Hashing password before storing
    $password = password_hash($data['password'], PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (first_name,last_name,email,password,role) VALUES (?,?,?,?,?)");
    $success = $stmt->execute([$data['first_name'],$data['last_name'],$data['email'],$password,$data['role']]);

    echo json_encode(['success'=>$success]);
} else {
    echo json_encode(['success'=>false,'message'=>'Missing data']);
}
?>
