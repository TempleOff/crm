<?php 
    require_once('../config/connect.php');
    $note = $_POST['note'];
    $date_time = date("Y-m-d H:i:s");
    $client_id = $_POST['id'];

    mysqli_query($connect,"INSERT INTO `coments` (`id`, `client_id`, `date_time`, `coment`) VALUES (NULL, '$client_id', '$date_time', '$note')");
    header('Location:../main.php');
?>