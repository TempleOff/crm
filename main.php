<?php
    session_start();
    error_reporting(0);
    require_once('config/connect.php');
    $company_name = $_SESSION['db_name'];

    $users = mysqli_query($connect,"SELECT * FROM `users`");
    $users = mysqli_fetch_all($users);

    $clients = mysqli_query($connect,"SELECT * FROM `clients`");
    $clients = mysqli_fetch_all($clients);

    $history = mysqli_query($connect,"SELECT * FROM `history`");
    $history = mysqli_fetch_all($history);
    //для источников
    $clients_sourse = mysqli_query($connect,"SELECT `source` FROM `clients`");
    $clients_sourse = mysqli_fetch_all($clients_sourse);

    $table_source = array();

    foreach($clients_sourse as $src){
        
        if(!in_array($src[0],$table_source) ){
            array_push($table_source,$src[0]);
        }
    }
    //для кол-во клиентов
    $table_count = array();

    foreach($table_source as $src){
        $clients_sourse = mysqli_query($connect,"SELECT `source` FROM clients WHERE source = '$src'");
        if(mysqli_num_rows($clients_sourse) >= 1){
            array_push( $table_count,mysqli_num_rows($clients_sourse));
        }
    }
    //для прибыли 
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
    //для отчета кол-во заказов и суммирования ценника
    $client_task_count = array();
    $client_task_price = array();
    foreach($clients as $client_id){
        $task_price = mysqli_query($connect,"SELECT `price` FROM task WHERE client_id = '$client_id[0]'");
        array_push($client_task_count,mysqli_num_rows($task_price));
        $task_price = mysqli_fetch_all($task_price);
        $out_price = 0;
        foreach($task_price as $price){
            $out_price = $out_price+$price[0];
        }
        array_push($client_task_price,$out_price);
    }
    //
    $users_task_count = array();
    $users_task_price = array();
    $users_SA = array();
    $user_comment_count = array();
    foreach ($users as $user) {
        $task_price = mysqli_query($connect,"SELECT `price`,`id` FROM task WHERE supervisor_id = '$user[0]'");
        array_push($users_task_count,mysqli_num_rows($task_price));
        $task_price = mysqli_fetch_all($task_price);
        $out_price = 0;
        foreach($task_price as $price){
            $out_price = $out_price+$price[0];
        }
        array_push($users_task_price,$out_price);

        $comment_count = 0;
        foreach($task_price as $price){
            $comment = mysqli_query($connect,"SELECT * FROM comments WHERE supervisor_id = '$user[0]'");
            //echo (mysqli_num_rows($comment));
            array_push($user_comment_count,mysqli_num_rows($comment));
        }

    }
    for ($i=0; $i < count($users_task_count); $i++) { 
        if ($users_task_count[$i]==0) {
            array_push($users_SA,0);
        }else{
            array_push($users_SA,($user_comment_count[$i]/$users_task_count[$i]));
        }
        
    }
?>

<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <link rel="stylesheet" href="assets/css/style_main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
</head>
<body>
    <header>
        <ul>
            <li><?php echo ($company_name);?></li>
            <li><a href="#" onclick="roles()">Сотрудники</a></li>
            <li><a href="#" onclick="clients()">Клиенты</a></li>
            <li><a href="#" onclick="history()">История</a></li>
            <li><a href="#" onclick="reports()">Отчеты</a></li>
            <li><a href="vendor/exit.php">Выход</a></li>
            
        </ul>
    </header>
    <!---->
    <div class="roles" id="form_roles"> <!--Форма для просмотра сотрудников и добавления-->
        <table>
            <tr>
                <th>Имя</th>
                <th>Пароль</th>
                <th>Должность</th>
                <th>Роль</th>
            </tr>

            <?php
                foreach($users as $usersItems){
            ?>
                <tr>
                    <td><?php echo $usersItems[1];?></td>
                    <td><?php echo $usersItems[2];?></td>
                    <td><?php echo $usersItems[5];?></td>
                    <td><?php echo $usersItems[4];?></td>
                    <td><a href="vendor/del_user.php?id=<?php echo $usersItems[0];?>">Удалить</a></td>
                    <td><a href="vendor/update_user.php?id=<?php echo $usersItems[0];?>" onclick="show_update()">Изменить</a></td>
                </tr>
            <?php        
            }
            ?>
        </table>  

        <form action="vendor/create_user.php" method="post">
            <label>Логин</label>
            <input name="new_login" type="text" placeholder="Введите имя"required autocomplete="off">
            <label>Пароль</label>
            <input name="new_password" type="text" placeholder="Введите пароль"required autocomplete="off">
            <label>Должность</label>
            <input name="new_post" type="text" placeholder="Введите должность"required autocomplete="off">
            <label>Роль</label>
            <select name="new_role" id="">
                <option value="Администратор">Администратор</option>
                <option value="Сотрудник">Сотрудник</option>
            </select>
            <button type="susbmit">Создать</button>
        </form>

        <form action="vendor/update_user.php" class="update_user" id="form_update_user">
            <label>Логин</label>
            <input name="new_login" type="text" placeholder="Введите имя">
            <label>Пароль</label>
            <input name="new_password" type="text" placeholder="Введите пароль">
            <label>Должность</label>
            <input name="new_post" type="text" placeholder="Введите должность">
            <label>Роль</label>
            <select name="new_role" id="">
                <option value="Администратор">Администратор</option>
                <option value="Сотрудник">Сотрудник</option>
            </select>
            <button type="susbmit">Изменить</button>
            <button type="button">Отменить изменения</button>
        </form>          
    </div>

    <div class="clients" id="form_clients">
        <input type="text" placeholder="Поиск">
        <a href="vendor/new_client.php">Добавить нового клиента</a>
        <table>
            <tr>
                <th>Дата регистрации</th>
                <th>ФИО</th>
                <th>Телефон</th>
                <th>Почта</th>
                <th>Рабочая область</th>
            </tr>

            <?php
                foreach($clients as $client){
            ?>
                <tr>
                    <td><?php echo $client[7];?></td>
                    <td><a href="client_card.php?id=<?php echo $client[0];?>"><?php echo $client[1];?></a></td>
                    <td><?php echo $client[3];?></td>
                    <td><?php echo $client[4];?></td>
                    <td><a href="<?php echo $client[5];?>"><?php echo $client[5];?></a></td>
                </tr>
            <?php        
            }
            ?>

        </table>  
    </div>

    <div class="history" id="form_history">

        <table>
            <tr>
                <th>Дата и время</th>
                <th>Комитор</th>
                <th>Категория изменения</th>
                <th>Изменение</th>
            </tr>

            <?php
                foreach($history as $story){
            ?>
                <tr>
                    <td><?php echo $story[1];?></td>
                    <td><?php echo $story[2];?></td>
                    <td><?php echo $story[3];?></td>
                    <td><?php echo $story[4];?></td>
                </tr>
            <?php        
            }
            ?>

        </table>  
    </div>
    
    <br>
    
    <div class="reports" id="form_reports">
        <div class="tabs">
            <div class="tab">
                <input type="radio" id="tab1" name="tab-group" checked>
                <label for="tab1" class="tab-title">Отчеты по источникам</label> 
                <section class="tab-content">
                    <table>
                        <tr>
                            <th>Источники</th>
                            <th>Кол-во клиентов</th>
                            <th>Прибыль</th>
                        </tr>
                        <?php
                           for ($i=0; $i < count($table_source); $i++) { 
                        ?>
                            <tr>
                                <td><?php echo $table_source[$i];?></td>
                                <td><?php echo $table_count[$i];?></td>
                                <td><?php echo $table_price[$i];?></td>
                            </tr>
                        <?php        
                        }
                        ?>
                    </table>  
                </section>
            </div> 
            <div class="tab">
                <input type="radio" id="tab2" name="tab-group">
                <label for="tab2" class="tab-title">Доход с клиентов</label> 
                <section class="tab-content">
                    <table>
                        <tr>
                            <th>ФИО</th>
                            <th>Источник</th>
                            <th>Кол-во заказов</th>
                            <th>Доход</th>
                        </tr>
                        <?php
                           for ($i=0; $i < count($clients); $i++) { 
                        ?>
                            <tr>
                                <td><?php echo $clients[$i][1];?></td>
                                <td><?php echo $clients[$i][8];?></td>
                                <td><?php echo $client_task_count[$i];?></td>
                                <td><?php echo $client_task_price[$i];?></td>
                            </tr>
                        <?php        
                        }
                        ?>
                    </table>  
                </section>
            </div>
            <div class="tab">
                <input type="radio" id="tab3" name="tab-group">
                <label for="tab3" class="tab-title">Эффективность сотрудников</label> 
                <section class="tab-content">
                    <table>
                        <tr>
                            <th>Имя сотрудника</th>
                            <th>Кол-во заказов</th>
                            <th>Доход</th>
                            <th>Средняя активность</th>
                        </tr>
                        <?php
                           for ($i=0; $i < count($users); $i++) { 
                        ?>
                            <tr>
                                <td><?php echo $users[$i][1]?></td>
                                <td><?php echo $users_task_count[$i]?></td>
                                <td><?php echo $users_task_price[$i]?></td>
                                <td><?php echo $users_SA[$i]?></td>
                            </tr>
                        <?php        
                        }
                        ?>
                    </table> 
                </section> 
            </div> 
        </div>
    </div>



</body>
<script src="assets/scripts/Script.js"></script>
</html>