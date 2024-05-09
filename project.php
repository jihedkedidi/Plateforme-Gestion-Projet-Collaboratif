<?php
require_once 'DBConnection.php';

class Project {
    private $pdo;

    public function __construct() {
        $db = new DBConnection();
        $this->pdo = $db->getConnection();
    }

    public function addProject($project_name, $description, $project_status) {
        try {
            $sql = "INSERT INTO projects (project_name, description, project_status) VALUES (:project_name, :description, :project_status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':project_name', $project_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':project_status', $project_status);
            $stmt->execute();
            return "New record created successfully";
        } catch (PDOException $e) {
            return "Failed: " . $e->getMessage();
        }
    }

    public function getAllProjects() {
        $query = "SELECT * FROM projects";
        $stmt = $this->pdo->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateProject($id, $project_name, $description, $project_status) {
        $query = "UPDATE projects SET project_name = :project_name, description = :description, project_status = :project_status WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':project_name', $project_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':project_status', $project_status);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function deleteProject($id) {
        $query = "DELETE FROM projects WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function getProjectById($id) {
        $query = "SELECT * FROM projects WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
