<?php
require_once 'config.php';

class Database{

    private const DSN = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
    private $conn;

    //method to connect to database
    public function __construct(){
        try{
            $this->conn=new PDO(self::DSN,DB_USER,DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            echo'database connected';
        }catch(PDOExeption $e){
            echo 'Connection Failed : '.$e->getMessage();
        }
    }
    //method Register User
    public function register($name, $email, $password){
    
        $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute([
                'name' => $name,
                'email' => $email,
                'password' => $password
            ]);
            echo 'user added';
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    public function registerAdmin($name, $email, $password,$role){
    
        $sql = "INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->conn->prepare($sql);
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
    //method to login as a user
    public function login($email,$password){
        $sql="SELECT * FROM users WHERE email = :email";
        $stmt= $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if($user){
            if(password_verify($password,$user['password'])){
                return $user;
            }else{
                return false;
            }   
        }else{
            return false;
        }
    }   
    
    //check email exits
    public function getUserByEmail($email){
        $sql="SELECT * FROM users WHERE email = :email ";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute([
            'email' => $email,
        ]);
        $user=$stmt->fetch();
        return $user;
    }
}
?>