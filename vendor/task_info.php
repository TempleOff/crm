<?php
    require_once('../config/connect.php');

    $user_name = $_SESSION['user_name'];
    $date_time = date("Y-m-d H:i:s", strtotime($date_time . ' +2 hours'));

    $task_name = $_POST['task_name'];

    $task_id = $_POST['id'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $status = $_POST['status'];

    $client = $_SESSION['id_client'];

    $query_content = ""; //заполнение тела запроса 

    if($description != null){
        $query_content = $query_content.'`desc`=\''.$description.'\'';
    }
    if( $price != null){
        if($query_content != "") $query_content = $query_content.', ';
        $query_content = $query_content.'`price`=\''. $price.'\'';
    }
    if($status != null){
        if($query_content != "") $query_content = $query_content.', ';
        $query_content = $query_content.'`status`=\''.$status.'\'';
    }
   
    if($query_content != ""){
        mysqli_query($connect,"UPDATE `task` SET $query_content WHERE  `task`.`id` = $task_id");
        mysqli_query($connect,"INSERT INTO `history` (`id`, `data_time`, `user`, `change_name`, `changed_info`) VALUES (NULL, '$date_time ', '$user_name', 'Изменение в задаче', '$task_name')");

    }


    header("Location:../client_card.php?id={$client}");

?>