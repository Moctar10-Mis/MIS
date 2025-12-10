<?php
session_start();
require __DIR__ . '/php/db_connect.php';
require_once __DIR__ . '/php/auth_check.php';
require_role('fi'); // Only allow FI users



// Redirect if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: FacultyLogin.php");
    exit;
}

// Function to check user role
function require_role($role) {
    if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
        header("HTTP/1.1 403 Forbidden");
        exit("Access denied. You do not have permission to view this page.");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Faculty Intern Dashboard</title>
<link rel="stylesheet" href="CSS/styleFiDashbord.css">
</head>
<body>
<div class="navbar">
  <h2>Faculty Intern Dashboard</h2>
  <ul>
    <li><a href="FiDashboard.php">My Courses</a></li>
    <li><a href="profile.php">Profile</a></li>
    <li><a href="logout.php" class="btn-logout">Logout</a></li>
  </ul>
</div>
<div class="content container">
  <h3>Welcome, <?= htmlspecialchars($_SESSION['first_name'] . ' ' . ($_SESSION['last_name'] ?? '')) ?></h3>

  <section id="courseManagement" class="section">
    <h4>Create Course</h4>
    <form id="createCourseForm">
      <input name="title" placeholder="Course title" required>
      <input name="code" placeholder="Course code" required>
      <button type="submit">Create</button>
    </form>
  </section>

  <section class="section">
    <h4>Manage Join Requests</h4>
    <div id="requestsList"></div>
  </section>
</div>

<script>
document.getElementById('createCourseForm').addEventListener('submit', async function(e){
  e.preventDefault();
  const title = this.title.value.trim();
  const code = this.code.value.trim();
  const res = await fetch('php/create_course.php', {
    method:'POST', headers:{'Content-Type':'application/json'},
    body: JSON.stringify({title, code})
  });
  const data = await res.json();
  if (data.success) { alert('Course created'); }
  else alert('Error');
});
</script>
<script src="JS/logout.js"></script>
</body>
</html>
