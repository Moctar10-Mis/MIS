<?php
// php/auth_check.php
if (session_status() === PHP_SESSION_NONE) session_start();

if (empty($_SESSION['user_id'])) {
    // not logged in - redirect to login page
    header('Location:LoginStudent.php'); // adjust path to your login page
    exit;
}

