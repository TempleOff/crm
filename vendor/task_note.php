<?php
    require_once('../config/connect.php');
    $comment = $_POST['comment'];
    $user_name = $_SESSION['user_name'];
    $date_time = date("Y-m-d H:i:s", strtotime($date_time . ' +2 hours'));
    $task_id = $_POST['id'];
    $client = $_SESSION['id_client'];
    $user_id = $_SESSION['user_id'];

    mysqli_query($connect,"INSERT INTO `comments` (`id`, `task_id`, `user_name`, `date_time`, `coment`,`supervisor_id`) VALUES (NULL, '$task_id', '$user_name', '$date_time', '$comment','$user_id')");

    header("Location:../client_task.php?id={$client}");

?>