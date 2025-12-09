<?php
require_once __DIR__ . '/../php/auth_check.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<title>Student Dashboard</title>
<link rel="stylesheet" href="../CSS/styleStudentDashbord.css">
<link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
<div class="navbar">
  <h2>Student Dashboard</h2>
  <ul>
    <li><a href="StudentDashboard.php">My Courses</a></li>
    <li><a href="attendance.php">Attendance</a></li>
    <li><a href="profile.php">Profile</a></li>
    <li><a href="#" class="btn-logout">Logout</a></li>
  </ul>
</div>
<div class="content container">
  <h3>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h3>
  <div id="coursesList"></div>
</div>
<script src="../JS/courses.js"></script>
<script src="../JS/logout.js"></script>
</body>
</html>
