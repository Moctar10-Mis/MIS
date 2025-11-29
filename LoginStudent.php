<?php
session_start();

// Dummy credentials (replace with database later)
$users = [
    "moctar" => "password123",
    "student1" => "pass1"
];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(isset($users[$username]) && $users[$username] === $password){
        $_SESSION['student_name'] = $username;
        header("Location: StudentDashboard.php");
        exit();
    } else {
        echo "<p style='color:red;'>Invalid username or password.</p>";
    }
}
?>
<a href="index.php">Back to login</a>
