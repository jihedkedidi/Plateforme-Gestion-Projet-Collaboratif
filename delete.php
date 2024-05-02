<?php
require_once 'User.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = new User();
    $msg = $user->deleteUser($id); // Implement this method in the User class
    header("Location: index.php?msg=$msg");
    exit();
}
?>
