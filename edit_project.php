<?php
require_once 'project.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $project = new Project();
    $projectData = $project->getProjectById($id);
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $project = new Project();
    $msg = $project->updateProject($id, $_POST['project_name'], $_POST['description'], $_POST['project_status']);
    header("Location: index.php?msg=$msg");
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
    <h2>Edit Project</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <input type="hidden" name="id" value="<?php echo $projetData['id']; ?>">
        <div class="form-group">
            <label for="project_name">Project Name:</label>
            <input type="text" class="form-control" id="project_name" name="project_name" value="<?php echo $projetData['project_name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo $projetData['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="project_status">Project Status:</label>
            <select class="form-select" id="project_status" name="project_status" required>
                <option value="Pending" <?php if ($projectData['project_status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                <option value="In Progress" <?php if ($projetData['project_status'] == 'In Progress') echo 'selected'; ?>>In Progress</option>
                <option value="Completed" <?php if ($projectData['project_status'] == 'Completed') echo 'selected'; ?>>Completed</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
</div>
</body>
</html>
