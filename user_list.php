<?php

session_start();
include 'db.php';
// Use __DIR__ to avoid path issues
require_once(__DIR__ . '/php/auth_check.php'); 
require_once(__DIR__ . '/php/db_connect.php');


// Initialize $users as empty array in case DB fails
$users = [];

try {
    // Prepare and execute the query safely
    $stmt = $pdo->query("SELECT id, username, email, role FROM users ORDER BY id DESC");
    if ($stmt) {
        $users = $stmt->fetchAll();
    }
} catch (PDOException $e) {
    // Display error message (can be logged instead of echoing in production)
    echo "Database error: " . htmlspecialchars($e->getMessage());
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Users</title>
    <link rel="stylesheet" href="CSS/style.css"> <!-- Adjust path if CSS is elsewhere -->
</head>
<body>
    <div class="navbar">
        <a href="StudentDashboard.php">Dashboard</a>
        <a href="#" class="btn-logout">Logout</a>
    </div>

    <div class="container">
        <h2>All Users</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
              <tbody>
    <?php if (!empty($users)): ?>
        <?php foreach($users as $u): ?>
            <tr>
                <td><?php echo $u['id']; ?></td>
                <td><?php echo htmlspecialchars($u['username']); ?></td>
                <td><?php echo htmlspecialchars($u['email']); ?></td>
                <td><?php echo htmlspecialchars($u['role']); ?></td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">No users found.</td>
        </tr>
    <?php endif; ?>
</tbody>

                