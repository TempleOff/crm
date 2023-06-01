<?php 
    session_start();
    require_once('../config/connect.php');
    $id = $_SESSION['id_client'];
    
    $user_name = $_SESSION['user_name'];
    $date_time = date("Y-m-d H:i:s");

    $result = mysqli_query($connect, "SELECT fio FROM clients WHERE id = $id");
    $client = mysqli_fetch_assoc($result);
    $client = implode(' ', $client);

    mysqli_query($connect,"INSERT INTO `history` (`id`, `data_time`, `user`, `change_name`, `changed_info`) VALUES (NULL, '$date_time ', '$user_name', 'Удаление клиента', '$client')");

    mysqli_query($connect,"DELETE FROM `clients` WHERE `clients`.`id` = $id;");
    mysqli_query($connect,"DELETE FROM `task` WHERE `task`.`client_id` = $id;");


    header('Location: ../main.php');

?>