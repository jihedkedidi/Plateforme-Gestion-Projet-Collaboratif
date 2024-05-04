<?php
require_once 'config.php';

class User {

        private const DSN = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
        private $db;

        public function __construct(){
            try{
                $this->db=new PDO(self::DSN,DB_USER,DB_PASS);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                
            }catch(PDOExeption $e){
                echo 'Connection Failed : '.$e->getMessage();
            }
        }
    
    public function addUser($name, $email, $password, $role) {
        $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $password,
                'role' => $role,
            ]);
            echo 'user added';
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getUserById($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUser($id, $name, $email, $role, $password) {
        $sql = "UPDATE users SET name = :name, email = :email, role = :role, password = :password WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        try {
            $stmt->execute([
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'role' => $role,
                'password' => $password
            ]);
            return "User updated successfully";
        } catch(PDOException $e) {
            return 'Error: ' . $e->getMessage();
        }
    }
}
?>
