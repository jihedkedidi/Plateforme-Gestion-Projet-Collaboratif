<?php
class DBConnection {
    private $servername = "localhost";
    private $username = "root";
    private $password = "root123";
    private $dbname = "bdprojet";
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
