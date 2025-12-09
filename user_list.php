<?php require_once __DIR__ . '/../php/auth_check.php'; require_once __DIR__ . '/../php/db_connect.php';
$stmt = $pdo->query("SELECT id, username, email, role FROM users ORDER BY id DESC");
$users = $stmt->fetchAll();
?>
<!DOCTYPE html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Users</title>
<link rel="stylesheet" href="/CSS/style.css"></head><body>
<div class="navbar"><a href="StudentDashboard.php">Dashboard</a> <a href="#" class="btn-logout">Logout</a></div>
<div class="container">
  <h2>All Users</h2>
  <table>
    <thead><tr><th>ID</th><th>Username</th><th>Email</th><th>Role</th></tr></thead>
    <tbody>
    <?php foreach($users as $u): ?>
      <tr><td><?php echo $u['id']; ?></td><td><?php echo htmlspecialchars($u['username']); ?></td><td><?php echo htmlspecialchars($u['email']); ?></td><td><?php echo $u['role']; ?></td></tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</div>
<script src="/JS/logout.js"></script>
</body></html>
