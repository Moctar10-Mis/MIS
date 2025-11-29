<?php
// Start session and protect page
session_start();
if(!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'faculty'){
    header("Location: FiLogin.php"); // Redirect if not logged in as faculty
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Faculty Dashboard</title>
<link rel="stylesheet" href="../CSS/styleFacultyDashboard.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<nav>
    <h1>Faculty Intern Dashboard</h1>
    <button id="logoutBtn">Logout</button>
</nav>

<div class="dashboard-content">
    <h2>Welcome, <?php echo htmlspecialchars($_SESSION['name']); ?>!</h2>
    <p>This is your faculty dashboard. Here you can manage attendance, view students, and more.</p>
    <!-- Add more features here -->
</div>

<script>
// Logout functionality
document.getElementById('logoutBtn').addEventListener('click', async function() {
    const result = await fetch('../logout.php', { method: 'POST' });
    const data = await result.json();

    if(data.logout){
        Swal.fire('Logged out','You have successfully logged out','success')
        .then(()=> window.location.href = '../FiLogin.php');
    }
});
</script>
</body>
</html>
