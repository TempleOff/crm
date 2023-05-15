<?php 
    session_start();
    require_once('../config/connect.php');
    $company_name = $_SESSION['db_name'];

    $new_login = $_POST['new_login'];
    $new_password = $_POST['new_password'];
    $new_role = $_POST['new_role'];
    $new_post = $_POST['new_post'];

    mysqli_query($connect,"INSERT INTO `users` (`id`, `name`, `password`, `company_name`, `roles`, `post`) VALUES (NULL, '$new_login', '$new_password', '$company_name', '$new_role', '$new_post')");
    header('Location: ../main.php');
?>