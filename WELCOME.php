<?php
session_start();
include __DIR__ . '/php/db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/WELCOME.css">
    <title>Welcome</title>
    <!-- FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome To Student Attendance Management System</h1>

        <div class="links">
            <a href="LoginStudent.php"><i class="fas fa-user-graduate"></i> Student Login</a>
            <a href="FacultyLogin.php"><i class="fas fa-chalkboard-teacher"></i> Faculty Login</a>
            <a href="FiLogin.php"><i class="fas fa-user-tie"></i> Faculty Intern Login</a>
        </div>

        <a class="outside-link" href="About.php">About Us</a>
    </div>
</body>
</html>
