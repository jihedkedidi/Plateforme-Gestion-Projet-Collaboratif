<?php
include "db_conn.php"; // Include the file with PDO connection

$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $role = $_POST['role']; // Updated from 'gender' to 'role'
    $password = $_POST['password']; // New field

    try {
        $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Set the PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement
        $stmt = $pdo->prepare("UPDATE `crud` SET `first_name`=:first_name, `last_name`=:last_name, `email`=:email, `role`=:role, `password`=:password WHERE id = :id");

        // Bind parameters
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':role', $role);
        $stmt->bindParam(':password', $password);

        // Execute the statement
        $stmt->execute();

        header("Location: index.php?msg=Data updated successfully");
    } catch (PDOException $e) {
        echo "Failed: " . $e->getMessage();
    }
}

// Fetch existing data for the selected user
try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare SQL statement to fetch user data by ID
    $stmt = $pdo->prepare("SELECT * FROM `crud` WHERE id = :id LIMIT 1");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the data
} catch (PDOException $e) {
    echo "Failed: " . $e->getMessage();
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
  Plateforme-Gestion-Projet-Collaboratif  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Edit User Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name:</label>
            <input type="text" class="form-control" name="first_name" value="<?php echo $row['first_name'] ?>">
          </div>

          <div class="col">
            <label class="form-label">Last Name:</label>
            <input type="text" class="form-control" name="last_name" value="<?php echo $row['last_name'] ?>">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Email:</label>
          <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
        </div>

        <div class="form-group mb-3">
          <label>Role:</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="role" id="devOps" value="devOps" <?php echo ($row["role"] == 'devOps') ? "checked" : ""; ?>>
          <label for="admin" class="form-input-label">deVops</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="role" id="Testeur" value="Testeur" <?php echo ($row["role"] == 'Testeur') ? "checked" : ""; ?>>
          <label for="user" class="form-input-label">Testeur</label>
          &nbsp;
          <input type="radio" class="form-check-input" name="role" id="Developpeur" value="Developpeur" <?php echo ($row["role"] == 'Developpeur') ? "checked" : ""; ?>>
          <label for="user" class="form-input-label">User</label>
        </div>

        <div class="mb-3">
          <label class="form-label">Password:</label>
          <input type="password" class="form-control" name="password" placeholder="Enter new password">
        </div>


        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBI
