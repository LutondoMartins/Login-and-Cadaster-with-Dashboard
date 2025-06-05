<?php
$host = 'localhost';
$dbname = 'francy_dashboard';
$username = 'root'; // Substitua pelo seu usuário do MySQL
$password = ''; // Substitua pela sua senha do MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>