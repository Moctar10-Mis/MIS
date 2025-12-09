<?php
// Correct include paths
require_once('php/auth_check.php');
require_once('php/db_connect.php');

// Get current user ID from session
$user_id = $_SESSION['user_id'] ?? null;
if (!$user_id) {
    // If no user is logged in, redirect to login
    header('Location: LoginStudent.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = $_POST['status'] ?? 'Absent';
    $stmt = $pdo->prepare("INSERT INTO attendance (user_id, status) VALUES (:uid, :st)");
    $stmt->execute(['uid' => $user_id, 'st' => $status]);
    header('Location: attendance.php');
    exit;
}

// Fetch attendance history
$stmt = $pdo->prepare("SELECT * FROM attendance WHERE user_id = :uid ORDER BY time DESC");
$stmt->execute(['uid' => $user_id]);
$rows = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Attendance</title>
    <link rel="stylesheet" href="CSS/style.css">
</head>
<body>
    <div class="navbar">
        <a href="StudentDashboard.php">Dashboard</a>
        <a href="#" class="btn-logout">Logout</a>
    </div>
    <div class="container">
        <h2>Mark Attendance</h2>
        <form method="post">
            <select name="status">
                <option>Present</option>
                <option>Absent</option>
            </select>
            <button type="submit">Submit</button>
        </form>
        <h3>Your Attendance History</h3>
        <table>
            <thead>
                <tr><th>ID</th><th>Status</th><th>Time</th></tr>
            </thead>
            <tbody>
                <?php foreach($rows as $r): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($r['id']); ?></td>
                        <td><?php echo htmlspecialchars($r['status']); ?></td>
                        <td><?php echo htmlspecialchars($r['time']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script src="JS/logout.js"></script>
</body>
</html>
