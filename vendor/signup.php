<?php   
    require_once('../config/connect.php'); 

    $name_user = $_POST['name_user']; 
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $company_name = $_POST['company_name'];


    if($password === $password_confirm){// Это проверка на правильность пароля 
        mysqli_query($connect,"CREATE DATABASE $company_name");
        mysqli_query($connect,"CREATE TABLE `$company_name`.`users` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `company_name` VARCHAR(255) NOT NULL , `roles` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        mysqli_query($connect,"INSERT INTO `$company_name`. `users` (`id`, `name`, `password`, `company_name`, `roles`) VALUES (NULL, '$name_user', '$password', '$company_name', 'Создатель')");
    }
    else{
        header('Location:../register.php');
    }

?>