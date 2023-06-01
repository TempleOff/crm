<?php 
    session_start();
    require_once('../config/connect.php');
    
    $new_fio = !empty($_POST['up_fio']) ? trim($_POST['up_fio']) : '';
    $new_address = !empty($_POST['up_address']) ? trim($_POST['up_address']) : '';
    $new_telephone = !empty($_POST['up_telephone']) ? trim($_POST['up_telephone']) : '';
    $new_mail = !empty($_POST['up_mail']) ? trim($_POST['up_mail']) : '';
    $new_link = !empty($_POST['up_link']) ? trim($_POST['up_link']) : '';
    $new_note = !empty($_POST['up_note']) ? trim($_POST['up_note']) : '';
    $new_date = !empty($_POST['up_date']) ? trim($_POST['up_date']) : '';
    $new_source = !empty($_POST['up_source']) ? trim($_POST['up_source']) : '';

    $new_fio = htmlspecialchars($new_fio);
    $new_address = htmlspecialchars($new_address);
    $new_telephone = htmlspecialchars($new_telephone);    
    $new_mail = htmlspecialchars($new_mail);
    $new_link = htmlspecialchars($new_link);
    $new_note = htmlspecialchars($new_note);
    $new_date = htmlspecialchars($new_date);
    $new_source = htmlspecialchars($new_source);


    $user_name = $_SESSION['user_name'];
    $date_time = date("Y-m-d H:i:s", strtotime($date_time . ' +2 hours'));

    mysqli_query($connect,"INSERT INTO `history` (`id`, `data_time`, `user`, `change_name`, `changed_info`) VALUES (NULL, '$date_time ', '$user_name', 'Новый клиент', '$new_fio')");

    mysqli_query($connect,"INSERT INTO `clients` (`id`, `fio`, `address`, `telephone`, `mail`, `link`, `note`, `register_date`, `source`) VALUES (NULL, '$new_fio', '$new_address', '$new_telephone', '$new_mail', ' $new_link', '$new_note', '$new_date', '$new_source')");
    header('Location: ../main.php');
?>