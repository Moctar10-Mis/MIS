<?php
require_once ('php/auth_check.php');
require_once ('php/db_connect.php');
$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT username, email FROM users WHERE id = :id");
$stmt->execute(['id'=>$user_id]);
$user = $stmt->fetch();
?>
<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>Profile</title>
<link rel="stylesheet" href="/CSS/style.css"></head>
<body>
<div class="navbar"><a href="StudentDashboard.php">Dashboard</a> <a href="#" class="btn-logout">Logout</a></div>
<div class="container">
  <h2>Profile</h2>
  <form method="post" action="/php/update_profile.php">
    <input name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
    <input name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
    <button type="submit">Update</button>
  </form>
</div>
<script src="/JS/logout.js"></script>
</body>
</html>
