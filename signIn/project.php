<?php
require_once 'config.php';

class Project {

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

        // Your other met
    public function addProject($name, $description) {
        $sql = "INSERT INTO projects (name, description) VALUES (:name, :description)";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute([
                'name' => $name,
                'description' => $description,
            ]);
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    
    public function getAllProjects() {
        $query = "SELECT * FROM projects";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    public function getProjectById($id) {
        $query = "SELECT * FROM projects WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function updateProject($id, $name, $description) {
        $sql = "UPDATE projects SET name = :name, description = :description WHERE id = :id";
        $stmt = $this->db->prepare($sql);
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
    public function deleteProject($id) {
        // First, delete project assignments associated with the project
        $query = "DELETE FROM project_assignments WHERE project_id = :project_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':project_id', $id);
        $stmt->execute();
    
        // Then, delete the project itself
        $query = "DELETE FROM projects WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        
        return $stmt->execute();
    }
    
    function assignUserToProject($userId, $projectId) {
        $stmt = $db->prepare("INSERT INTO project_assignments (user_id, project_id) VALUES (?, ?)");
        $stmt->execute([$userId, $projectId]);
    }
    public function getProjectsByUserId($id) {
        $query = "SELECT * FROM project_assignments WHERE user_id = :user_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':user_id', $id);
        $stmt->execute();
        $projectIds = $stmt->fetchAll(PDO::FETCH_COLUMN, 1); // Fetch project ids

        $query = "SELECT * FROM projects WHERE id IN (" . implode(",", $projectIds) . ")";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
     
}
?>
