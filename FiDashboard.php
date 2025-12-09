<?php
require_once __DIR__ . '/../php/role_check.php';
require_role('faculty');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Faculty Dashboard</title>
<link rel="stylesheet" href="../CSS/styleFacultyDashbord.css">
<link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<div class="navbar">
  <h2>Faculty Dashboard</h2>
  <ul>
    <li><a href="FiDashboard.php">My Courses</a></li>
    <li><a href="profile.php">Profile</a></li>
    <li><a href="#" class="btn-logout">Logout</a></li>
  </ul>
</div>
<div class="content container">
  <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h3>
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
  const res = await fetch('/php/create_course.php', {
    method:'POST', headers:{'Content-Type':'application/json'},
    body: JSON.stringify({title,code})
  });
  const data = await res.json();
  if (data.success) { alert('Course created'); }
  else alert('Error');
});
</script>
<script src="../JS/logout.js"></script>
</body>
</html>
