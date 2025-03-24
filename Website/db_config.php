<?php
// db_config.php

$host = 'localhost';
$dbname = 'grainsandoil';
$user = 'root'; // change this if needed
$pass = '';     // your DB password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
