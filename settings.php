<?php
$host = "127.0.0.1";     // XAMPP MySQL Server
$username = "root";      // Username For XAMPP
$password = "";          // Password For XAMPP (Blank)
$database = "eoi"; // Database name


// Connect To MySQL
$conn = mysqli_connect($host, $username, $password, $database);


// Connect Checking
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
