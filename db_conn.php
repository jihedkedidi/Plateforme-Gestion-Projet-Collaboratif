<?php
$servername = "localhost"; // Update with your MySQL host
$username = "root"; // Update with your MySQL username
$password = "root123"; // Update with your MySQL password
$dbname = "bdprojet"; // Update with your MySQL database name

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "CONNECT SUCCESS"; // Corrected success message
} catch(PDOException $e) {
    echo "ERROR: " . $e->getMessage(); // Updated error message format
}
?>


