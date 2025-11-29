<?php
// Start session
session_start();

// Check if user is already logged in
if(isset($_SESSION['student_name'])){
    header("Location: StudentDashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Login</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <h1>Student Login</h1>
        <form action="LoginStudent.php" method="post">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="RegisterStudent.php">Register here</a></p>
    </div>
</body>
</html>
