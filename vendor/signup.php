<?php   
    require_once('../config/connect.php'); 

    $name_user = $_POST['name_user']; 
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];
    $company_name = $_POST['company_name'];


    if($password === $password_confirm){
        mysqli_query($connect,"CREATE DATABASE $company_name");
        mysqli_query($connect,"CREATE TABLE `$company_name`.`users` (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(255) NOT NULL , `password` VARCHAR(255) NOT NULL , `company_name` VARCHAR(255) NOT NULL , `roles` VARCHAR(255) NOT NULL ,`post` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        mysqli_query($connect,"INSERT INTO `$company_name`. `users` (`id`, `name`, `password`, `company_name`, `roles`,`post`) VALUES (NULL, '$name_user', '$password', '$company_name', 'Создатель','')");

        mysqli_query($connect,"CREATE TABLE `$company_name`.`clients` (`id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `fio` VARCHAR(255) NOT NULL , `address` VARCHAR(255) NOT NULL , `telephone` VARCHAR(255) NOT NULL , `mail` VARCHAR(255) NOT NULL , `link` VARCHAR(255) NOT NULL , `note` VARCHAR(255) NOT NULL , `register_date` VARCHAR(255) NOT NULL , `source` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        mysqli_query($connect,"CREATE TABLE `$company_name`.`comments` (`id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `task_id` INT NOT NULL ,`user_name` VARCHAR(255) NOT NULL , `date_time` VARCHAR(255) NOT NULL , `coment` TEXT NOT NULL ,`supervisor_id` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        mysqli_query($connect,"CREATE TABLE `$company_name`.`history`(`id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `data_time` VARCHAR(255) NOT NULL , `user` VARCHAR(255) NOT NULL , `change_name` VARCHAR(255) NOT NULL , `changed_info` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        mysqli_query($connect,"CREATE TABLE `$company_name`.`task` (`id` INT UNSIGNED NOT NULL AUTO_INCREMENT , `client_id` INT NOT NULL , `name_task` VARCHAR(255) NOT NULL , `desc`TEXT, `status` VARCHAR(20),`price` INT ,`supervisor_id` INT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;");
        
        header('Location:../index.php');
    }
    else{
        header('Location:../register.php');
    }

?>