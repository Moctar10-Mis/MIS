<?php
$servername = "localhost";
$username = "moctar.issoufou";
$password = "Mis10@.#";  
$dbname = "webtech_2025A_moctar_issoufou";


//Mis10@.#
//webtech_2025A_moctar_issoufou
//moctar.issoufou


 //Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);}
?>
