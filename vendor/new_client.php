<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление клиента</title>
    <link rel="stylesheet" href="../assets/css/style_client.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
</head>
<body>
    <div class="client_info">
        <form class="form_clientInfo" action="create_client.php" method="post">
            <label>Фамилия Имя Отчество</label>
            <input name="up_fio" type="text" value="<?= $client['fio']?>"required autocomplete="off">
            <br>
            <label>Адрес</label>
            <input name="up_address" type="text" value="<?= $client['address']?>"required autocomplete="off">
            <br>
            <label>Телефон</label>
            <input name="up_telephone" type="text" value="<?= $client['telephone']?>"required autocomplete="off">
            <br>
            <label>Почта</label>
            <input name="up_mail" type="text" value="<?= $client['mail']?>"required autocomplete="off">
            <br>
            <label>Рабочая область</label>
            <input name="up_link" type="text" value="<?= $client['link']?>"required autocomplete="off">
            <br>
            <label>Примечание</label>
            <input name="up_note" type="text" value="<?= $client['note']?>"required autocomplete="off">
            <br>
            <label>Дата регистрации</label>
            <input name="up_date" type="date" value="<?= $client['register_date']?>"required autocomplete="off">
            <br>
            <label>Источник</label>
            <select name="up_source"required>
                <option value="<?= $client['source'] ?>" selected><?= $client['source'] ?></option>
                <option value="Интернет">Интернет</option>
                <option value="Социальные сети">Социальные сети</option>
                <option value="Знакомые">Знакомые</option>
                <option value="Рассылка">Рассылка</option>
                <option value="ТВ">ТВ</option>
                <option value="Радио">Радио</option>
            </select>
            <br>
            <button type="submit">Добавить клиента</button>
        </form>
        <a href="../main.php">Назад</a>
    </div>
</body>
</html>