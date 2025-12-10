<?php
session_start();
include 'php/db_connect.php'; // Make sure this defines $conn

$error = "";
$success = "";

if(isset($_POST['register'])) {

    // Get form data
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if($password !== $confirm_password){
        $error = "Passwords do not match!";
    } else {
        // Check if email already exists
        $stmt_check = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $result_check = $stmt_check->get_result();

        if($result_check->num_rows > 0){
            $error = "Email already registered! Please login or use another email.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $role = 'student';

            // Insert new user
            $stmt = $conn->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param("sssss", $first_name, $last_name, $email, $hashed_password, $role);

            if($stmt->execute()){
                $success = "Registration successful! You can now <a href='LoginStudent.php'>login</a>.";
            } else {
                $error = "Error: " . $stmt->error;
            }
            $stmt->close();
        }
        $stmt_check->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register Student</title>
<link rel="stylesheet" href="CSS/styleStudentRegister.css">
</head>
<body>
<div class="div1">
    <h1>Student Registration</h1>

    <?php if($error) echo "<p style='color:red;'>$error</p>"; ?>
    <?php if($success) echo "<p style='color:green;'>$success</p>"; ?>

    <form method="POST" action="">
        <input type="text" name="first_name" placeholder="User First Name" required>
        <input type="text" name="last_name" placeholder="User Last Name" required>
        <input type="email" name="email" placeholder="User Email" required>
        <input type="password" name="password" placeholder="User Password" required>
        <input type="password" name="confirm_password" placeholder="Confirm Your Password" required>
        <br><br>
        <button type="submit" name="register">Register</button>
    </form>
</div>
</body>
</html>
