<?php
session_start();
if(!isset($_SESSION['student_name'])){
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="container">
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['student_name']); ?>!</h1>
        <p>This is your dashboard.</p>
        <a href="Logout.php">Logout</a>
    </div>
</body>
</html>
