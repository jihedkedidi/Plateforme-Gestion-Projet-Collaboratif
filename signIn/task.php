<?php
require_once 'config.php';

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
    //1- add task
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
    
    function getTasksForUser($db, $userId) {
        $stmt = $db->prepare("
            SELECT tasks.* 
            FROM tasks 
            JOIN task_assignments ON tasks.id = task_assignments.task_id 
            WHERE task_assignments.user_id = ?
        ");
        $stmt->execute([$userId]);
    
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //2- update task
    function updateTask($db, $taskId, $name, $description, $projectId, $dueDate) {
        $stmt = $db->prepare("UPDATE tasks SET name = ?, description = ?, project_id = ?, due_date = ? WHERE id = ?");
        $stmt->execute([$name, $description, $projectId, $dueDate, $taskId]);
    }



    //2- add task
    public function addTask($task, $user_id) {
        $status = 'pending';
        $sql = "INSERT INTO tasks (task, status, user_id) VALUES (:task, :status, :user_id)";
        $stmt = $this->db->prepare($sql);
        try {
            $stmt->execute([
                'task' => $task,
                'status' => $status,
                'user_id' => $user_id,
            ]);
            echo 'task added';
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }
    //after choosing a project in the first step the admin gonna choose from the users list the users that he gonna afect the task as per defaults the status is pending 

}

?>