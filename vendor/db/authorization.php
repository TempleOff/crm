<?php  
    session_start();
    require_once('../../config/connect.php'); 

    $company_name = !empty($_POST['company_name']) ? trim($_POST['company_name']) : '';
    $login = !empty($_POST['login']) ? trim($_POST['login']) : '';
    $paswd = !empty($_POST['password']) ? trim($_POST['password']) : '';
    
    $company_name = htmlspecialchars($company_name);
    $login = htmlspecialchars($login);
    $paswd = htmlspecialchars($paswd);

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
        header('Location:../../index.php');
        exit();
    }
    error_reporting(E_ALL);
    $connect = $con;

    $sql = "SELECT id FROM users WHERE name='$login' AND password='$paswd'";
    $result = mysqli_query($connect, $sql);  
    
    if (mysqli_num_rows($result) == 1) {
        $result = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $result['id'];
        header("Location:../../main.php?role=");
    } else {
        header("Location:../../index.php");
    }
    
?>