<?php
require_once 'Project.php';

$project = new Project();
$projects = $project->getAllProjects();
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Project Management Platform</title>
   <!-- Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
   <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
       Project Management Platform
   </nav>
   <div class="container">
       <h2>Project List</h2>
       <table class="table table-striped">
           <thead>
               <tr>
                   <th>ID</th>
                   <th>Project Name</th>
                   <th>Description</th>
                   <th>Project Status</th>
                   <th>Action</th>
               </tr>
           </thead>
           <tbody>
               <?php foreach ($projects as $project): ?>
                   <tr>
                       <td><?php echo $project['id']; ?></td>
                       <td><?php echo $project['project_name']; ?></td>
                       <td><?php echo $project['description']; ?></td>
                       <td><?php echo $project['project_status']; ?></td>
                       <td>
                           <a href="edit_project.php?id=<?php echo $project['id']; ?>" class="btn btn-primary">Edit</a>
                           <a href="delete_project.php?id=<?php echo $project['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                       </td>
                   </tr>
               <?php endforeach; ?>
           </tbody>
       </table>
       <a href="add_new_project.php" class="btn btn-success">Add New Project</a>
   </div>
   <!-- Bootstrap -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
