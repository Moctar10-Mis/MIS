<?php
// php/role_check.php
require_once __DIR__ . '/auth_check.php';

function require_role($role) {
    if (empty($_SESSION['role']) || $_SESSION['role'] !== $role) {
        // redirect to unauthorized or homepage
        header('Location: /HTML/WELCOME.html');
        exit;
    }
}

