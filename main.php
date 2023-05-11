<?php
    session_start();
    require_once('config/connect.php');
    $company_name = $_SESSION['db_name'];

        $role = mysqli_query($connect,"SELECT * FROM `users`");
        $role = mysqli_fetch_all($role);

    $tables = array();
    $result = mysqli_query($connect, "SHOW TABLES");
    while ($row = mysqli_fetch_array($result)) {
        if($table!="user"){
            $tables[] = $row[0];
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
    <script src="assets/scripts/Script.js"></script>
    
</head>
<body>
    <header>
        <ul>
            <li><?php echo ($company_name);?></li>
            <li><a href="#" onclick="roles()">Сотрудники</a></li>
            <li><details>
                <summary>Таблицы</summary>
                <button onclick="createTable()">Создать + </button>

                <?php
                foreach($tables as $table){
                    if($table == "users") continue;
                ?>
                <button>
                    <?php echo $table; ?>
                </button>
                <?php        
                }
                ?>

            </details></li>
            <li><a href="#">История</a></li>
            <li><a href="vendor/exit.php">Выход</a></li>
        </ul>
    </header>
    <!---->
    <div class="roles" id="form_roles"> <!--Форма для просмотра сотрудников и добавления-->
        <table>
            <tr>
                <th>Имя</th>
                <th>Пароль</th>
                <th>Роль</th>
            </tr>

            <?php
                foreach($role as $roleItems){
            ?>
                <tr>
                    <td><?php echo $roleItems[1];?></td>
                    <td><?php echo $roleItems[2];?></td>
                    <td><?php echo $roleItems[4];?></td>
                    <td><a href="vendor/del_user.php?id=<?php echo $roleItems[0];?>">Удалить</a></td>
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
            <label>Роль</label>
            <input name="new_role" type="text" placeholder="Введите должность">
            <button type="susbmit">Создать</button>
        </form>            
    </div>

    <div class="create_table" id="form_create-table">
        <form action="vendor/create_table.php" method="post">
            <label>Название новой таблицы</label>
            <input name="name_table" type="text" placeholder="Введите название таблицы">
            <br>
            <div id="table_content"> 
                <div value="1" id="colum_1">
                    <label>Введите название колонки</label>
                    <input name="name_table-pillar" type="text" placeholder="Введите название колонок">
                    <label>Введите тип данной колонки</label>
                    <select name="column1_type" id="column1_type" >
                    <option value="INT">INT</option>
                    <option value="VARCHAR">VARCHAR</option>
                    <option value="TEXT">TEXT</option>
                    </select>
                    
                </div>           
            </div>
        <button type="submit">Создать таблицу</button>
        </form>
        <button onclick="click()">Добавить +</button>
    </div>
    
    
</body>
</html>