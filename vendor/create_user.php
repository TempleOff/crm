<?php 
    session_start();
    require_once('../config/connect.php');
    $company_name = $_SESSION['db_name'];
    
    $user_name = $_SESSION['user_name'];
    $date_time = date("Y-m-d H:i:s", strtotime($date_time . ' +2 hours'));

    $new_login = $_POST['new_login'];
    $new_password = $_POST['new_password'];
    $new_role = $_POST['new_role'];
    $new_post = $_POST['new_post'];

    mysqli_query($connect,"INSERT INTO `history` (`id`, `data_time`, `user`, `change_name`, `changed_info`) VALUES (NULL, '$date_time ', '$user_name', 'Новый пользователь', '$new_login')");

    mysqli_query($connect,"INSERT INTO `users` (`id`, `name`, `password`, `company_name`, `roles`, `post`) VALUES (NULL, '$new_login', '$new_password', '$company_name', '$new_role', '$new_post')");
    header('Location: ../main.php');
?>