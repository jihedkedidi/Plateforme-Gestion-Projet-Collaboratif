<?php
require_once 'config.php';

class Database{

    private const DSN = 'mysql:host='.DB_HOST.';dbname='.DB_NAME;
    private $conn;
    private $pdo;
    public function __construct(){
        try{
            $this->conn=new PDO(self::DSN,DB_USER,DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
        }catch(PDOExeption $e){
            echo 'Connection Failed : '.$e->getMessage();
        }
    }
    public function getConnection() {
        return $this->pdo;
    }
    public function getProjectById($id) {
        $query = "SELECT * FROM projects WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
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
    function addTask($db, $name, $description, $projectId, $dueDate, $userIds) {
        // Insert the new task into the tasks table
            $stmt = $db->prepare("INSERT INTO tasks (name, description, project_id, due_date) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $description, $projectId, $dueDate]);
            
            // Get the ID of the task we just inserted
            $taskId = $db->lastInsertId();
    
            // Assign the task to each user
            foreach ($userIds as $userId) {
                $stmt = $db->prepare("INSERT INTO task_assignments (user_id, task_id) VALUES (?, ?)");
                $stmt->execute([$userId, $taskId]);
            }
    }
    public function addProject($name, $description) {
        $sql = "INSERT INTO projects (name, description) VALUES (:name, :description)";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute([
                'name' => $name,
                'description' => $description,
            ]);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
        return $this->conn->lastInsertId();
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
    public function updateProject($id, $name, $description) {
        $sql = "UPDATE projects SET name = :name, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        try {
            $stmt->execute([
                'id' => $id,
                'name' => $name,
                'description' => $description,
            ]);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
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
    //check email exits
    public function getUserById($id){
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt=$this->conn->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);
        $user=$stmt->fetch();
        return $user;
    }
    //getALLUsers
    public function getAllUsers(){
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        return $users;
    }
    public function updateUser($id, $name, $email, $role, $password) {
        $sql = "UPDATE users SET name = :name, email = :email, role = :role, password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
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
    public function deleteUser($id) {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
    public function getAllRoles(){
        $sql = "SELECT role FROM users ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $enums = $stmt->fetch();
        return $enums;
    }
    public function getAllUsersNames(){
        $sql = "SELECT name FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $usersNames = $stmt->fetchAll();
        return $usersNames;
    }
    public function getUserIdByName($name){
        $sql = "SELECT id FROM users WHERE name = :name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'name' => $name,
        ]);
        $userId = $stmt->fetch();
        return $userId;
    }
    public function assignUserToProject($userId, $projectId) {
        $sql = "INSERT INTO project_assignments (user_id, project_id) VALUES (:userId, :projectId)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            'userId' => $userId,
            'projectId' => $projectId
        ]);
    }
    
    

}
?>