<?php
    session_start();
    require_once('config/connect.php');
    $company_name = $_SESSION['db_name'];

    $role = mysqli_query($connect,"SELECT * FROM `users`");
    $role = mysqli_fetch_all($role);

    $clients = mysqli_query($connect,"SELECT * FROM `clients`");
    $clients = mysqli_fetch_all($clients);

    $history = mysqli_query($connect,"SELECT * FROM `history`");
    $history = mysqli_fetch_all($history);
?>

<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <link rel="stylesheet" href="assets/css/style_main.css">
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
                foreach($role as $roleItems){
            ?>
                <tr>
                    <td><?php echo $roleItems[1];?></td>
                    <td><?php echo $roleItems[2];?></td>
                    <td><?php echo $roleItems[5];?></td>
                    <td><?php echo $roleItems[4];?></td>
                    <td><a href="vendor/del_user.php?id=<?php echo $roleItems[0];?>">Удалить</a></td>
                    <td><a href="vendor/update_user.php?id=<?php echo $roleItems[0];?>" onclick="show_update()">Изменить</a></td>
                </tr>
            <?php        
            }
            ?>
        </table>  

        <form action="vendor/create_user.php" method="post">
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
    
    <div class="reports" id="form_reports">
        <p>тут будет находится таблица с отчетами</p>
    </div>



</body>
<script src="assets/scripts/Script.js"></script>
</html>