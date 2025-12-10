<?php
session_start();
include 'php/db_connect.php'; 

$error = "";


if(isset($_POST['email']) && isset($_POST['password'])) {

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember_me']); 

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && password_verify($password, $user['password'])) {
        // Set session variables
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['role'] = $user['role'];

        if($remember) {
            // Set cookies for 30 days (less secure: password stored in cookie)
            setcookie("user_email", $email, time() + (30*24*60*60), "/");
            setcookie("user_password", $password, time() + (30*24*60*60), "/");
        }

        header("Location: StudentDashboard.php");
        exit;
    } else {
        $error = "Incorrect email or password!";
    }

    $stmt->close();
}

// Auto-login using cookies if session not set
if(!isset($_SESSION['user_id']) && isset($_COOKIE['user_email']) && isset($_COOKIE['user_password'])) {
    $email = $_COOKIE['user_email'];
    $password = $_COOKIE['user_password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['role'] = $user['role'];
        header("Location: StudentDashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Login</title>
<link rel="stylesheet" href="CSS/styleStudentLogin.css">
<style>
/* Temporary inline CSS to test */
body { font-family: Arial; background-color: #f2f2f2; }
.login-container { display: flex; justify-content: center; align-items: center; height: 100vh; }
.login-box { background: #fff; padding: 30px; border-radius: 10px; width: 350px; box-shadow: 0 0 15px rgba(0,0,0,0.2); }
.login-box h1, .login-box h2 { text-align: center; }
.login-box input { width: 100%; padding: 10px; margin: 5px 0; border-radius: 5px; border: 1px solid #ccc; }
.login-box button { width: 100%; padding: 10px; background: #0052cc; color: white; border: none; border-radius: 5px; cursor: pointer; }
.login-box button:hover { background: #003d99; }
.error { color: red; text-align: center; }
.register-link { text-align: center; margin-top: 10px; }
</style>
</head>
<body>
<div class="login-container">
    <div class="login-box">
        <h1>Ashesi University</h1>
        <h2>Student Login</h2>

        <?php if($error) echo "<p class='error'>$error</p>"; ?>

        <form method="POST" action="">
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>

            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>

            <label>
                <input type="checkbox" name="remember_me"> Remember Me
            </label>

            <button type="submit">Login</button>
        </form>

        <p class="register-link">Don't have an account? <a href="RegisterStudent.php">Register here</a></p>
    </div>
</div>
</body>
</html>
