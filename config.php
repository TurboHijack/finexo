<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "finexo";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "....................";
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
