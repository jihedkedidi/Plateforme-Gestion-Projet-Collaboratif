<?php
include "db_conn.php"; // Include the file with PDO connection

$id = $_GET["id"];

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement
    $stmt = $pdo->prepare("DELETE FROM `crud` WHERE id = :id");

    // Bind parameters
    $stmt->bindParam(':id', $id);

    // Execute the statement
    $stmt->execute();

    header("Location: index.php?msg=Data deleted successfully");
} catch (PDOException $e) {
    echo "Failed: " . $e->getMessage();
}
?>

