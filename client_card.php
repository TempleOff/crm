<?php
    require_once('config/connect.php');
    $client_id = $_GET['id'];
    $_SESSION['id_client'] = $client_id;

    $client = mysqli_query($connect,"SELECT * FROM `clients` WHERE `id`='$client_id'");
    $client = mysqli_fetch_assoc($client);

    //$notes = mysqli_query($connect,"SELECT * FROM `coments` WHERE `client_id`='$client_id'");
    //$notes = mysqli_fetch_all($notes);

    $task = mysqli_query($connect,"SELECT * FROM `task` WHERE `client_id`='$client_id'");
    $task = mysqli_fetch_all($task);
?>
<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <link rel="stylesheet" href="assets/css/style_client.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
</head>
<body>   
    <div class="client_info">
        <form class="form_clientInfo" action="vendor/update_client.php" method="post">
            <input type="hidden" name="id" value="<?= $client_id?>">

            <label>Фамилия Имя Отчество</label>
            <input name="up_fio" type="text" value="<?= $client['fio']?>">
            <br>
            <label>Адрес</label>
            <input name="up_address" type="text" value="<?= $client['address']?>">
            <br>
            <label>Телефон</label>
            <input name="up_telephone" type="text" value="<?= $client['telephone']?>">
            <br>
            <label>Почта</label>
            <input name="up_mail" type="text" value="<?= $client['mail']?>">
            <br>
            <label>Рабочая область</label>
            <input name="up_link" type="text" value="<?= $client['link']?>">
            <br>
            <label>Примечание</label>
            <input name="up_note" type="text" value="<?= $client['note']?>">
            <br>
            <label>Дата регистрации</label>
            <input name="up_date" type="date" value="<?= $client['register_date']?>">
            <br>
            <label>Источник</label>
            <select name="up_source">
                <option value="<?= $client['source'] ?>" selected><?= $client['source'] ?></option> 
                <option value="Интернет">Интернет</option>
                <option value="Социальные сети">Социальные сети</option>
                <option value="Знакомые">Знакомые</option>
                <option value="Рассылка">Рассылка</option>
                <option value="ТВ">ТВ</option>
                <option value="Радио">Радио</option>
            </select>
            <br>
            <button type="submit">Обновить данные</button>
        </form>
        <a href="main.php">Назад</a>
        <br>
        <a href="vendor/del_client.php">удалить клиента</a>
        <br>
        <h2>Заказы клиента</h2>
        <form action="vendor/create_task.php" method="post">
            <input name="new_task" type="text">
            <button type="submit">Добавить заказ</button>
        </form>

        <table>
            <tr>
                <th>Наименование заказа</th>
                <th>Статус заказа</th>
            </tr>
            <?php
                foreach($task as $tsk){
            ?>
                <tr>
                    <td><?php echo $tsk[2];?></td>
                    <td><?php echo $tsk[4];?></td>
                    <td><a href="client_task.php?id=<?php echo $tsk[0];?>">Параметры</a></td>
                </tr>
            <?php        
            }
            ?>
        </table>
    </div> 
</body>
</html>