<?php
    require_once('config/connect.php');
    include_once('vendor/date_base.php');
    $client_id = !empty($_GET['id']) ? trim($_GET['id']) : '';

    $client_id = htmlspecialchars($client_id);

    $_SESSION['id_client'] = $client_id;

    $client = get_clients_to_client_card($connect,$client_id);

    $task = get_tasks_to_client_card($connect,$client_id);
?>
<?php include_once('templets\header.php'); ?>
<div class="client_card">
    <div class="client_info">
        <form class="form_clientInfo" action="vendor/db/update_client.php" method="post">
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
        <a href="main.php?client=">Назад</a>
        <br>
        <a href="vendor/db/del_client.php">удалить клиента</a>
        <br>
        <h2>Заказы клиента</h2>
        <form action="vendor/db/create_task.php" method="post">
            <input name="new_task" type="text"required autocomplete="off">
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
                    <td><?php echo $tsk[1];?></td>
                    <td><?php echo $tsk[2];?></td>
                    <td><a href="client_task.php?id=<?php echo $tsk[0];?>">Параметры</a></td>
                </tr>
            <?php        
            }
            ?>
        </table>
    </div> 
</div>
<?php include_once('templets\footer.php'); ?>