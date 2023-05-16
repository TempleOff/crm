<?php 
    session_start();
    require_once('../config/connect.php');
    $id = $_GET['id'];
    
    $user_name = $_SESSION['user_name'];
    $date_time = date("Y-m-d H:i:s", strtotime($date_time . ' +2 hours'));

    $result = mysqli_query($connect, "SELECT * FROM users WHERE id = $id");
    $client = mysqli_fetch_assoc($result);
    $client = implode(' ', $client);

    mysqli_query($connect,"INSERT INTO `history` (`id`, `data_time`, `user`, `change_name`, `changed_info`) VALUES (NULL, '$date_time ', '$user_name', 'Удаление пользователя', '$client')");

    mysqli_query($connect,"DELETE FROM `users` WHERE `users`.`id` = $id;");


    header('Location: ../main.php');

?>