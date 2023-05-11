<?php 
    require_once('../config/connect.php');
    if($_SERVER['REQUEST_METHOD']=='POST'&& isset($_POST)){
        $id_colum = $_POST['colum_id'];
        $result = 'test';
        $response = $result;
        echo($response);
        exit;
    }
?>