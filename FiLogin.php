<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Faculty Login</title>
<link rel="stylesheet" href="../CSS/styleFacultyLogin.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<div class="container">
    <h1>Faculty Login</h1>
    <form id="loginForm">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="../RegisterFaculty.php">Register here</a></p>
</div>

<script>
document.getElementById('loginForm').addEventListener('submit', async function(e){
    e.preventDefault();
    const formData = new FormData(this);

    // Send login data to PHP backend
    const response = await fetch('../php/login.php', { method: 'POST', body: formData });
    const result = await response.json();

    if(result.success && result.role === 'faculty'){
        Swal.fire('Success','Login successful','success')
        .then(() => window.location.href = '../FiDashboard.php');
    } else {
        Swal.fire('Error','Invalid credentials or not a faculty account','error');
    }
});
</script>
</body>
</html>
