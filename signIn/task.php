<?php
require_once 'config.php';
require_once 'utils.php';
require_once 'database.php';    
class task{

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

    public function getConnection() {
        return $this->db;
    }
    
    
    public function addTask($name, $description, $project_id) {
        $sql = "INSERT INTO tasks (name, description, project_id) VALUES (:name, :description, :project_id)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute(['name' => $name, 'description' => $description, 'project_id' => $project_id]);
       
        return $this->db->lastInsertId();
    }
    

    public function assignUserToTask($userId, $taskId) {
        if ($userId !== false) {
            $stmt = $this->db->prepare("INSERT INTO task_assignments (user_id, task_id) VALUES (?, ?)");
            $stmt->execute([$userId, $taskId]);
        } else {
            echo $userId    ;   
            // Handle case where user doesn't exist
            echo $userId; 
            echo "User does not exist. Skipping assignment.<br>";
        }
    }
    

    public function getUserIdByName($name){
        $sql = "SELECT id FROM users WHERE name = :name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['name' => $name]);
        $userId = $stmt->fetchColumn(); 
        return $userId;
    }
    public function addTaskByAdmin($name, $description, $project_id, $members) {
        $taskId = $this->addTask($name, $description, $project_id);
        if ($taskId) {
            foreach ($members as $userName) {
                $userIds = $this->db->getUserIdByName($userName);
                if (is_array($userIds)) {
                    foreach ($userIds as $userId) {
                        $this->db->assignUserToTask($userId, $projectId);
                    }
                } elseif ($userIds !== false) {
                    $this->db->assignUserToTask($userIds, $projectId);
                } else {
                    // Handle case where user doesn't exist
                    echo "User $userName does not exist. Skipping assignment.<br>";
                }
            }
            Utils::setFlash('register_success', 'You are now registered and can now login!');
            Utils::redirect('project_view.php');
        } else {
            // Handle case where project creation failed
            echo "Failed to create project.<br>";
        }
        
    }
    
    
}

?>