<?php

require_once 'database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = new Database();
    require_once 'database.php';
    $db = new Database();
    //$roles = $db->getAllRoles();
    $userData = $user->getUserById($id);
    
}

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $user = new Database();
    $msg = $user->updateUser($id, $_POST['name'], $_POST['email'], $_POST['role'], $_POST['password']);
    header("Location: admin_profile.php");
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
        <input type="hidden" name="id" value="<?php echo $userData['id']; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $userData['name']; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $userData['email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="role">Role:</label>
            <input type="text" class="form-control" id="role" name="role" value="<?php echo $userData['role']; ?>" required>
        </div>
        <!-- <div class="form-group">
            <label for="role">Role:</label>
            <select name="role" id="role">
                <option value="w">--Please choose an option--</option>
                <?php foreach ($roles as $role): ?>
                    <option value="<?php echo $role['role']; ?>"><?php echo $role['role']; ?> </option>
                <?php endforeach; ?>
            </select>
        </div> -->
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $userData['password']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Update</button>
    </form>
</div>
</body>
</html>
