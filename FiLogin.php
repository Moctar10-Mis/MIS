<?php
session_start();
require __DIR__ . '/php/db_connect.php'; // Make sure this file sets $conn properly

$error = "";

// Process login
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Select FI user from database
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? AND role = 'fi'");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['last_name'] = $user['last_name'];
            $_SESSION['role'] = $user['role'];

            // Redirect to dashboard
            header("Location: FiDashboard.php");
            exit;
        } else {
            $error = "Incorrect password!";
        }
    } else {
        $error = "No FI account found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Faculty Intern Login</title>
<link rel="stylesheet" href="CSS/styleFiLogin.css">
</head>
<body>
<div class="form-container">
    <h1>Faculty Intern Login</h1>

    <?php if($error) echo "<p style='color:red;'>$error</p>"; ?>

    <form method="POST" action="">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>

    <p>Don't have an account? Contact Admin to create FI account.</p>
</div>
</body>
</html>
