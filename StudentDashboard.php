<?php
session_start();
include __DIR__ . '/php/db_connect.php';
require_once __DIR__ . '/php/auth_check.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Student Dashboard</title>
<link rel="stylesheet" href="CSS/styleStudentDashbord.css">
</head><script>
document.querySelector('.btn-logout').addEventListener('click', function (e) {
    e.preventDefault();

    fetch('php/logout.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(data => {
        if (data.logout) {
            window.location.href = 'WELCOME.php';
        } else {
            alert('Logout failed.');
        }
    })
    .catch(error => {
        alert('Network error during logout.');
        console.error(error);
    });
});
</script>


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
  <h3>Welcome, <?= htmlspecialchars($_SESSION['first_name'] . ' ' . ($_SESSION['last_name'] ?? '')) ?></h3>
  <div id="coursesList"></div>
</div>

<script src="JS/logout.js"></script>
<script src="JS/courses.js"></script>
</body>
</html>
