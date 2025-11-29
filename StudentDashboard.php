<?php include '../php/auth_check.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Student Dashboard</title>
<link rel="stylesheet" href="../CSS/styleDashboard.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<h1>Welcome, <?php echo $_SESSION['name']; ?></h1>
<button onclick="logout()">Logout</button>
<script src="../JS/logout.js"></script>
</body>
</html>
