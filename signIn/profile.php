<?php
session_start();
require_once 'utils.php';
include 'database.php';

$user = null;
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    User profile
                </div>
                
            <h2>Simple Table Example</h2>
            <table class="table">
            <tbody>
                <tr>
                    <td><?= $user['name']?></td>
                    <td><?= $user['email']?></td>
                    <td><?= $user['created_at']?></td>
                    <td><?= $user['updated_at']?></td>
                </tr>
            </tbody>
            </table>
</div>
</div>
</div>
</div> 

</body>
</html>