<?php
    require_once('config/connect.php');
    $task_id = !empty($_GET['id']) ? trim($_GET['id']) : '';

    $task_id = htmlspecialchars($task_id);

    $client_id = $_SESSION['id_client'];

    $notes = mysqli_query($connect,"SELECT user_name,date_time,coment FROM `comments` WHERE `task_id`='$task_id'");
    $notes = mysqli_fetch_all($notes);

    $task = mysqli_query($connect,"SELECT `name_task`,`desc`,`status`,`price` FROM `task` WHERE `id`='$task_id'");
    $task = mysqli_fetch_assoc($task);

    $task_name = $task['name_task'];
    $task_desk = $task['desc'];

    $result = mysqli_query($connect, "SELECT id FROM clients WHERE id = $client_id");
    $client = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html> <?php ?>
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
        <form class="client_info" action="vendor/task_info.php" method="post">
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

        <form action="vendor/task_note.php" method="post">
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
    <a href="../client_card.php?id=<?php echo $client['id']; ?>">Назад</a>
</body>
</html>