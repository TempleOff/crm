<?php 
    session_start();
    require_once('../config/connect.php');

    $user_name = $_SESSION['user_name'];
    $date_time = date("Y-m-d H:i:s", strtotime($date_time . ' +2 hours'));
    
    $client_id = $_SESSION['id_client'];

    $result = mysqli_query($connect, "SELECT * FROM clients WHERE id = $client_id");
    $client = mysqli_fetch_assoc($result);

    $new_task = $_POST['new_task'];

    $history_task = $history_task . "Клиент: ". $client['fio'] . " Заказ: " . $new_task. ";";

    mysqli_query($connect,"INSERT INTO `history` (`id`, `data_time`, `user`, `change_name`, `changed_info`) VALUES (NULL, '$date_time ', '$user_name', 'Новый заказ', '$history_task')");

    mysqli_query($connect,"INSERT INTO `task` (`id`, `client_id`, `name_task`, `desc`, `status`, `price`) VALUES (NULL, '$client_id', '$new_task', NULL, 'Создан', NULL)");

    header("Location:../client_card.php?id={$client['id']}");
?>