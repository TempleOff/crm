<?php
    require_once('config/connect.php');
    include_once('vendor/date_base.php');
    $task_id = !empty($_GET['id']) ? trim($_GET['id']) : '';

    $task_id = htmlspecialchars($task_id);

    $client_id = $_SESSION['id_client'];

    $notes = get_notes_to_task_card($connect,$task_id);

    $task = get_tasks_to_task_card($connect,$task_id);

    $task_name = $task['name_task'];
    $task_desk = $task['desc'];

    
?>
<?php include_once('templets\header.php'); ?>
<div class="client_card">
    <div class="client_info">
        <form class="client_info" action="vendor/db/task_info.php" method="post">
            <input type="hidden" name="id" value="<?= $task_id?>">
            <input type="hidden" name="task_name" value="<?= $task_name?>">
            <h1>Задача: <?php echo ($task_name)?></h1>
            <label for="">Описание заказа</label>
            <textarea name="description"  cols="30" rows="5"><?php echo $task['desc']?></textarea>
            <br>
            <input name="price" type="number" value="<?php echo $task['price']?>">
            <label for="">Статус заказа</label>
            <select name="status">
                <option value="<?= $task['status'] ?>" selected><?= $task['status'] ?></option> 
                <option value="В обработке">В обработке</option>
                <option value="Приостановлен">Приостановлен</option>
                <option value="Выполнено">Выполнено</option>
            </select>
            <button type="submit">Изменить данные</button>
        </form>

        <br>

        <form action="vendor/db/task_note.php" method="post">
            <input type="hidden" name="id" value="<?= $task_id?>">
            <input name="comment" type="text" placeholder="Введите коментарий"required autocomplete="off">
            <button type="submit">Добавить коментарий</button>
        </form>
        <table>
            <tr>
                <th>Дата и время</th>
                <th>Работник</th>
                <th>Коментарий</th>
            </tr>

            <?php
                foreach($notes as $note){
            ?>
                <tr>
                    <td><?php echo $note[1];?></td>
                    <td><?php echo $note[0];?></td>
                    <td><?php echo $note[2];?></td>
                </tr>
            <?php        
            }
            ?>
        </table> 

    </div>
    <a href="../client_card.php?id=<?php echo $client_id; ?>">Назад</a>
</div>
<?php include_once('templets\footer.php'); ?>