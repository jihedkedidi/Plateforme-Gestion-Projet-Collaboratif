<?php
require_once 'project.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $project = new project();
    $msg = $project->deleteProject($id);
    header("Location: index.php?msg=$msg");
    exit();
}
?>