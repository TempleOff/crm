<?php 
    session_start();
    require_once('../config/connect.php');
    $new_fio = $_POST['up_fio'];
    $new_address = $_POST['up_address'];
    $new_telephone = $_POST['up_telephone'];
    $new_mail = $_POST['up_mail'];
    $new_link = $_POST['up_link'];
    $new_note = $_POST['up_note'];
    $new_date = $_POST['up_date'];
    $new_source = $_POST['up_source'];

    $user_name = $_SESSION['user_name'];
    $date_time = date("Y-m-d H:i:s", strtotime($date_time . ' +2 hours'));

    mysqli_query($connect,"INSERT INTO `history` (`id`, `data_time`, `user`, `change_name`, `changed_info`) VALUES (NULL, '$date_time ', '$user_name', 'Новый клиент', '$new_fio')");

    mysqli_query($connect,"INSERT INTO `clients` (`id`, `fio`, `address`, `telephone`, `mail`, `link`, `note`, `register_date`, `source`) VALUES (NULL, '$new_fio', '$new_address', '$new_telephone', '$new_mail', ' $new_link', '$new_note', '$new_date', '$new_source')");
    header('Location: ../main.php');
?>