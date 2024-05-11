<?php

require_once 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $project = new Database();
    require_once 'database.php';
    $db = new Database();
    $projectData = $project->getProjectById($id);
    //$allProjectsStatus = $project->getAllProjectsStatus();
    
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $project = new Database();
    $msg = $project->updateProject($id, $_POST['name'], $_POST['description']);
    header("Location: project_view.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

   <!-- Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

   <title>PHP CRUD Application</title>
</head>

<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
   Plateforme-Gestion-Projet-Collaboratif     </nav>
<div class="container">
    <h2>Edit User</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $projectData['id']; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $projectData['name']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="description" class="form-control" id="description" name="description" value="<?php echo $projectData['description']; ?>" required>
        </div>
        
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
</div>
</body>
</html>
