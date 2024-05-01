<?php
$servername = "localhost:3305";
$username = "root"; // Replace 'your_username' with your MySQL username
$password = "root123"; // Replace 'your_password' with your MySQL password
$dbname = "bdprojet";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "";
} catch(PDOException $e) {
    echo " " . $e->getMessage();
}
?>
