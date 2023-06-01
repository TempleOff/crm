<?php
function get_source($clients_sourse){

    $table_source = array();

foreach($clients_sourse as $src){
    
    if(!in_array($src[0],$table_source) ){
        array_push($table_source,$src[0]);
    }
}
    return  $table_source;
}
function get_count_clients_in_sources($table_source,$connect){

    $table_count = array();

    foreach($table_source as $src){
        $clients_sourse = mysqli_query($connect,"SELECT `source` FROM clients WHERE source = '$src'");
        if(mysqli_num_rows($clients_sourse) >= 1){
            array_push( $table_count,mysqli_num_rows($clients_sourse));
        }
    }
    return  $table_count;
}
function get_price_in_sources($table_source,$connect){

    $table_price = array();

    foreach($table_source as $src){
        $client_id = mysqli_query($connect,"SELECT `id` FROM clients WHERE source = '$src'");
        $client_id = mysqli_fetch_all($client_id);
        $out_price = 0;
        foreach($client_id as $id){
            $task_price = mysqli_query($connect,"SELECT `price` FROM task WHERE client_id = '$id[0]'");
            $task_price = mysqli_fetch_all($task_price);
            
            foreach($task_price as $price){
                $out_price = $out_price+$price[0];
            }
            
        }
        array_push($table_price,$out_price);
    }
    return  $table_price;
}

function get_client_task_count($clients,$connect){

    $client_task_count = array();
    foreach($clients as $client_id){
        $task_price = mysqli_query($connect,"SELECT `price` FROM task WHERE client_id = '$client_id[0]'");
        array_push($client_task_count,mysqli_num_rows($task_price));
    }
    return  $client_task_count;
}

function get_client_task_price($clients,$connect){

    $client_task_price = array();
    foreach($clients as $client_id){
        $task_price = mysqli_query($connect,"SELECT `price` FROM task WHERE client_id = '$client_id[0]'");
        $task_price = mysqli_fetch_all($task_price);

        $out_price = 0;
        foreach($task_price as $price){
            $out_price = $out_price+$price[0];
        }
        array_push($client_task_price,$out_price);
    }
    return  $client_task_price;
}

function get_users_task_count($users,$connect){

    $users_task_count = array();
    foreach ($users as $user) {
        $task_price = mysqli_query($connect,"SELECT `price`,`id` FROM task WHERE supervisor_id = '$user[0]'");
        array_push($users_task_count,mysqli_num_rows($task_price));
    }
    return  $users_task_count;
}

function get_users_task_price($users,$connect){

    $users_task_price = array();
    foreach ($users as $user) {
        $task_price = mysqli_query($connect,"SELECT `price`,`id` FROM task WHERE supervisor_id = '$user[0]'");
        $task_price = mysqli_fetch_all($task_price);

        $out_price = 0;
        foreach($task_price as $price){
            $out_price = $out_price+$price[0];
        }
        array_push($users_task_price,$out_price);
    }
    
    return  $users_task_price;
}


function get_users_SA($users,$connect){

    $users_task_count = get_users_task_count($users,$connect);
    $user_comment_count = get_user_comment_count($users,$connect);////////
    
    $users_SA = array();

    for ($i=0; $i < count($users_task_count); $i++) { 
        if ($users_task_count[$i]==0) {
            array_push($users_SA,0);
        }else{
            array_push($users_SA,($user_comment_count[$i]/$users_task_count[$i]));
        }
        
    }
    
    return  $users_SA;
}


function get_user_comment_count($users,$connect){

    $user_comment_count = array();
    foreach ($users as $user) {
        $task_price = mysqli_query($connect,"SELECT `price`,`id` FROM task WHERE supervisor_id = '$user[0]'");
        $task_price = mysqli_fetch_all($task_price);
        
        foreach($task_price as $price){
            $comment = mysqli_query($connect,"SELECT `id` FROM comments WHERE supervisor_id = '$user[0]'");
            //echo (mysqli_num_rows($comment));
            array_push($user_comment_count,mysqli_num_rows($comment));
        }
    }
    return  $user_comment_count;
}



?>