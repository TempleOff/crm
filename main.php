<?php
    session_start();
    error_reporting(0);
    require_once('config/connect.php');
    include_once('vendor/date_base.php');
    include_once('vendor/calculate.php');
    $company_name = $_SESSION['db_name'];

    $users = get_all_users($connect);

    $clients = get_clients_to_main($connect);

    $history = get_history($connect);
    //для источников
    $clients_sourse = get_clients_sourse($connect);

    $table_source = get_source($clients_sourse);
    //для кол-во клиентов
    $table_count = get_count_clients_in_sources($table_source,$connect);
    //для прибыли 
    $table_price = get_price_in_sources($table_source,$connect);
    //для отчета кол-во заказов и суммирования ценника
    $client_task_count = get_client_task_count($clients,$connect);
    $client_task_price = get_client_task_price($clients,$connect);
    
    //
    $users_task_count = get_users_task_count($users,$connect);
    $users_task_price = get_users_task_price($users,$connect);
    $users_SA = get_users_SA($users,$connect);
    $user_comment_count = get_user_comment_count($users,$connect);
    
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
                    <td><?php echo $usersItems[4];?></td>
                    <td><?php echo $usersItems[3];?></td>
                    <td><a href="vendor/db/del_user.php?id=<?php echo $usersItems[0];?>">Удалить</a></td>
                    <td><a href="vendor/update_user.php?id=<?php echo $usersItems[0];?>" onclick="show_update()">Изменить</a></td>
                </tr>
            <?php        
            }
            ?>
        </table>  

        <form action="vendor/db/create_user.php" method="post">
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

        <form action="vendor/db/update_user.php" class="update_user" id="form_update_user">
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
        <a href="vendor/db/new_client.php">Добавить нового клиента</a>
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
                    <td><?php echo $client[5];?></td>
                    <td><a href="client_card.php?id=<?php echo $client[0];?>"><?php echo $client[1];?></a></td>
                    <td><?php echo $client[2];?></td>
                    <td><?php echo $client[3];?></td>
                    <td><a href="<?php echo $client[4];?>"><?php echo $client[4];?></a></td>
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
                    <td><?php echo $story[0];?></td>
                    <td><?php echo $story[1];?></td>
                    <td><?php echo $story[2];?></td>
                    <td><?php echo $story[3];?></td>
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
                                <td><?php echo $clients[$i][6];?></td>
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