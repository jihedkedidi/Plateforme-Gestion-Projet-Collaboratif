<?php
require_once 'project.php';
$db = new Project();
$projects = $db->getAllProjects(); // Implement this method in the User class
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
    <style>
        .sidebar {
            width: 30%;
            float: left;
        }

        .main-content {
            width: 70%;
            float: left;
        }
        .status-pending {
        background-color: #ffc107; /* Yellow */
        }

        .status-in-progress {
            background-color: #007bff; /* Blue */
        }

        .status-completed {
            background-color: #28a745; /* Green */
        }

    </style>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        Plateforme-Gestion-Projet-Collaboratif
    </nav>
    <div class="container">
        <div class="row">
            <div class="sidebar">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Navigation</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">
                                <a href="admin_profile.php" class="text-decoration-none">Users List</a>
                            </li>
                            <li class="list-group-item">
                                <a href="project_view.php" class="text-decoration-none">Project List</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="main-content">
                <h2>Projects List</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($projects as $project): ?>
                        <tr>
                            <td><?php echo $project['name']; ?></td>
                            <td><?php echo $project['description']; ?></td>
                            <td><span class="badge badge-pill  status-<?=$project['status']?>" ><?php echo $project['status']; ?></span></td>
                            <td>
                            <a href="add_task.php?id=<?php echo $project['id']; ?>" class="btn btn-primary">Add Task</a>
                            <a href="edit-project.php?id=<?php echo $project['id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete-project.php?id=<?php echo $project['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="add-new-project.php" class="btn btn-success">Add New Project</a>
            </div>
        </div>
    </div>
</body>

</html>