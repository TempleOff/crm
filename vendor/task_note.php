<?php
    require_once('../config/connect.php');

    $comment = !empty($_POST['comment']) ? trim($_POST['comment']) : '';
    $task_id = !empty($_POST['id']) ? trim($_POST['id']) : '';

    $comment = htmlspecialchars($comment);
    $task_id = htmlspecialchars($task_id);

    $date_time = date("Y-m-d H:i:s", strtotime($date_time . ' +2 hours'));

    $user_name = $_SESSION['user_name'];
    $client = $_SESSION['id_client'];
    $user_id = $_SESSION['user_id'];
    

    mysqli_query($connect,"INSERT INTO `comments` (`id`, `task_id`, `user_name`, `date_time`, `coment`,`supervisor_id`) VALUES (NULL, '$task_id', '$user_name', '$date_time', '$comment','$user_id')");

    header("Location:../client_task.php?id={$task_id}");

?>