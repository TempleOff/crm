<?php
    session_start();
    require_once('config/connect.php');
    $client_id = $_GET['id'];
    $_SESSION['id_client'] = $client_id;

    $client = mysqli_query($connect,"SELECT * FROM `clients` WHERE `id`='$client_id'");
    $client = mysqli_fetch_assoc($client);

    $notes = mysqli_query($connect,"SELECT * FROM `coments` WHERE `client_id`='$client_id'");
    $notes = mysqli_fetch_all($notes);
?>
<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <link rel="stylesheet" href="assets/css/style_client.css">
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
            <select name="up_source" name="new_role" id=""> <!--Нужно исправить-->
                <option value="<?= $client['source']?>"></option>
                <option value="Администратор">Администратор</option>
                <option value="Сотрудник">Сотрудник</option>
            </select>
            <br>
            <button type="submit">Обновить данные</button>
        </form>
        <a href="main.php">Назад</a>
        <a href="vendor/del_client.php">удалить клиента</a>
        <br>
        <h2>Заметки клиента</h2>
        <form action="vendor/note_client.php" method="post">
            <input type="hidden" name="id" value="<?= $client_id?>">

            <input name="note" type="text" placeholder="Введите заметку">
            <button type="submit">Добавить заметку</button>
        </form>
        <table>
            <tr>
                <th>Дата</th>
                <th>Текст</th>
            </tr>
            <?php
                foreach($notes as $note){
            ?>
                <tr>
                    <td><?php echo $note[2];?></td>
                    <td><?php echo $note[3];?></td>
                </tr>
            <?php        
            }
            ?>
        </table>  
    </div> 
</body>
</html>