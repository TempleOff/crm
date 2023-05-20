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

    $user_name = $_SESSION['user_name'];
    $date_time = date("Y-m-d H:i:s", strtotime($date_time . ' +2 hours'));

    $history_content = "";
    
    $result = mysqli_query($connect, "SELECT * FROM clients WHERE id = $id");
    $client = mysqli_fetch_assoc($result);

    
    if($client['fio'] != $up_fio){
        $history_content = $history_content . "ФИО было: ". $client['fio'] . " Фио стало: " . $up_fio . ";";
    }
    if($client['address'] != $up_address){
        $history_content = $history_content . "Адрес был: ". $client['address'] . " Адрес стал: " . $up_address . ";";
    }
    if($client['telephone'] != $up_telephone){
        $history_content = $history_content . "Тел. был: ". $client['telephone'] . " Тел. стал: " . $up_telephone . ";";
    }
    if($client['mail'] != $up_mail){
        $history_content = $history_content . "Почта была: ". $client['mail'] . " Почта стала: " . $up_mail . ";";
    }
    if($client['link'] != $up_link){
        $history_content = $history_content . "Ссылка была: ". $client['link'] . " Ссылка стала: " . $up_link . ";";
    }
    if($client['note'] != $up_note){
        $history_content = $history_content . "Примечания были: ". $client['note'] . " Примечания стали: " . $up_note . ";";
    }
    if($client['register_date'] != $up_date){
        $history_content = $history_content . "Дата регистрации было: ". $client['register_date'] . " Дата регистрации стало: " . $up_date . ";";
    }

    if($history_content != ""){
        mysqli_query($connect,"INSERT INTO `history` (`id`, `data_time`, `user`, `change_name`, `changed_info`) VALUES (NULL, '$date_time ', '$user_name', 'Изменение клиента', '$history_content')");
    }



    mysqli_query($connect,"UPDATE `clients` SET `fio` = '$up_fio', `address` = '$up_address', `telephone` = '$up_telephone', `mail` = '$up_mail', `link` = '$up_link', `note` = '$up_note', `register_date` = '$up_date', `source` = '$up_source' WHERE `clients`.`id` = '$id'");

    header('Location:../main.php');
?>