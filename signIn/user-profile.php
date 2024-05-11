<?php
session_start();
require_once 'utils.php';
require_once 'user.php';
include 'database.php';

$user = null;
if(isset($_SESSION['user'])){
    $user = $_SESSION['user'];
    $user_id = $user['id'];
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
    <style>
        body {
            background-color: #f8f9fa;
        }
        .user-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-top: 20px;
        }
        .user-card h2 {
            margin-bottom: 20px;
            color: #333;
        }
        .user-details-table {
            width: 100%;
        }
        .user-details-table td {
            padding: 10px;
        }
        .user-details-table td:first-child {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="user-card">
                    <h2>User Details</h2>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <table class="user-details-table">
                                <tbody>
                                    <tr>
                                        <td>Name:</td>
                                        <td><?php echo isset($user['name']) ? $user['name'] : ''; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Email:</td>
                                        <td><?php echo isset($user['email']) ? $user['email'] : ''; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>