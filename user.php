<?php
require_once 'DBConnection.php';

class User {
    private $pdo;

    public function __construct() {
        $db = new DBConnection();
        $this->pdo = $db->getConnection();
    }

    public function addUser($first_name, $last_name, $email, $role, $password) {
        try {
            $sql = "INSERT INTO `crud`(`first_name`, `last_name`, `email`, `role`, `password`) VALUES (:first_name, :last_name, :email, :role, :password)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':first_name', $first_name);
            $stmt->bindParam(':last_name', $last_name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':password', $password);
            $stmt->execute();
            return "New record created successfully";
        } catch (PDOException $e) {
            return "Failed: " . $e->getMessage();
        }
    }

    public function getAllUsers() {
        $query = "SELECT * FROM crud";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $first_name, $last_name, $email, $role, $password) {
        $query = "UPDATE curd SET first_name = :first_name, last_name = :last_name, email = :email, role = :role, password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $query = "DELETE FROM crud WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getUserById($id) {
        $query = "SELECT * FROM crud WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
