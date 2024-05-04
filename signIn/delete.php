<?php

require_once 'user.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user = new User();
    $msg = $user->deleteUser($id); // Implement this method in the User class
    header("Location: admin_profile.php?msg=$msg");
    exit();
}
?>
