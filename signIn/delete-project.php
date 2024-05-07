<?php

require_once 'project.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $project = new Project();
    $msg = $project->deleteProject($id); 
    header("Location: project_view.php?msg=$msg");
    exit();
}
?>
