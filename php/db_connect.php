<?php
$servername = "localhost";
$username = "root";
$password = "";  // or your MySQL password
$dbname = "attendance_db";


$conn = new mysqli('localhost', 'moctar.issoufou', '30692027', 'webtech_2025A_moctar_issoufou');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
