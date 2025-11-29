<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("Location: LoginStudent.php"); // redirect if not logged in
    exit;
}
?>
