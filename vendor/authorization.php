<?php  
    session_start();
    require_once('../config/connect.php'); 

    $company_name = $_POST['company_name'];
    $login = $_POST['login'];
    $paswd = $_POST['password'];
    
    $user_name = $login;
    $_SESSION['user_name'] = $user_name;//Имя пользователя
    $_SESSION['db_name']=$company_name;
    
    try{
        error_reporting(0);
        $con = mysqli_connect('localhost','root','',$company_name);
        if(!$con){
            throw new Exception();
        }
    }
    catch(Exception $ex){
        header('Location:../index.php');
        exit();
    }
    error_reporting(E_ALL);
    $connect = $con;

    $sql = "SELECT * FROM users WHERE name='$login' AND password='$paswd'";
    $result = mysqli_query($connect, $sql);  
    
    if (mysqli_num_rows($result) == 1) {
        header("Location:../main.php");
    } else {
        header("Location:../index.php");
    }

?>