<?php 
    require_once('../config/connect.php');
    $up_fio = $_POST['up_fio'];
    $up_address = $_POST['up_address'];
    $up_telephone = $_POST['up_telephone'];
    $up_mail = $_POST['up_mail'];
    $up_link = $_POST['up_link'];
    $up_note = $_POST['up_note'];
    $up_date = $_POST['up_date'];
    $up_source = $_POST['up_source'];

    $id = $_POST['id'];


    mysqli_query($connect,"UPDATE `clients` SET `fio` = '$up_fio', `address` = '$up_address', `telephone` = '$up_telephone', `mail` = '$up_mail', `link` = '$up_link', `note` = '$up_note', `register_date` = '$up_date', `source` = '$up_source' WHERE `clients`.`id` = '$id'");

    header('Location:../main.php');
?>