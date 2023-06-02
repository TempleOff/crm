<?php include_once('templets\header.php'); ?>
<div class="client_card">
    <div class="client_info">
        <form class="form_clientInfo" action="vendor/db/create_client.php" method="post">
            <label>Фамилия Имя Отчество</label>
            <input name="up_fio" type="text" required autocomplete="off">
            <br>
            <label>Адрес</label>
            <input name="up_address" type="text" required autocomplete="off">
            <br>
            <label>Телефон</label>
            <input name="up_telephone" type="text" required autocomplete="off">
            <br>
            <label>Почта</label>
            <input name="up_mail" type="text" required autocomplete="off">
            <br>
            <label>Рабочая область</label>
            <input name="up_link" type="text" required autocomplete="off">
            <br>
            <label>Примечание</label>
            <input name="up_note" type="text" required autocomplete="off">
            <br>
            <label>Дата регистрации</label>
            <input name="up_date" type="date" required autocomplete="off">
            <br>
            <label>Источник</label>
            <select name="up_source"required>
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
        <a href="../main.php?client=">Назад</a>
    </div>
</div>
<?php include_once('templets\footer.php'); ?>