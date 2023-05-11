<?php 
    session_start();
    $company_name = $_SESSION['db_name'];
    $connect = mysqli_connect('localhost','root','',$company_name);
?>