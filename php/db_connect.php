<?php
$host = "localhost";
// my database name
$db   = "attendance_db";
//my DB username
$user = "root";   
// The password of my DB        
$pass = "";               
try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
