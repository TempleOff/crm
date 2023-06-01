<?php
   
    function get_all_users($con){

        $users = mysqli_query($con,"SELECT `id`,`name`,`password`,`roles`,`post` FROM `users`");
        $users =  mysqli_fetch_all($users);
        return  $users;
    }
    function get_clients_to_main($con){

        $clients = mysqli_query($con,"SELECT `id`,`fio`,`telephone`,`mail`,`link`,`register_date`,`source` FROM `clients`");
    $clients = mysqli_fetch_all($clients);
        return  $clients;
    }
    function get_history($con){

        $history = mysqli_query($con,"SELECT `data_time`,`user`,`change_name`,`changed_info` FROM `history`");
    $history = mysqli_fetch_all($history);
        return  $history;
    }
    function get_clients_sourse($con){

        $clients_sourse = mysqli_query($con,"SELECT `source` FROM `clients`");
        $clients_sourse = mysqli_fetch_all($clients_sourse);
        return  $clients_sourse;
    }
    function get_clients_to_client_card($connect,$client_id){

        $client = mysqli_query($connect,"SELECT fio,address,telephone,mail,link,note,register_date,source FROM `clients` WHERE `id`='$client_id'");
        $client = mysqli_fetch_assoc($client);
        return  $client;
    }
    function get_tasks_to_client_card($connect,$client_id){

        $task = mysqli_query($connect,"SELECT `id`,`name_task`,`status` FROM `task` WHERE `client_id`='$client_id'");
        $task = mysqli_fetch_all($task);
        return  $task;
    }
    function get_notes_to_task_card($connect,$task_id){

        $notes = mysqli_query($connect,"SELECT user_name,date_time,coment FROM `comments` WHERE `task_id`='$task_id'");
        $notes = mysqli_fetch_all($notes);
        return  $notes;
    }
    function get_tasks_to_task_card($connect,$task_id){

        $task = mysqli_query($connect,"SELECT `name_task`,`desc`,`status`,`price` FROM `task` WHERE `id`='$task_id'");
        $task = mysqli_fetch_assoc($task);
        return  $task;
    }
    

?>