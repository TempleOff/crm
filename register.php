<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <form action="vendor/signup.php" method="post" autocomplete="off">
        <h1>Регистрация</h1>
        <label>Логин</label>
        <input type="text" name="name_user" placeholder="Введите ваше имя">
        <label>Пароль</label>
        <input type="password" name="password" placeholder="Создайте пароль">
        <label>Подтверждение пароля</label>
        <input type="password" name="password_confirm" placeholder="Введите ранее созданный пароль">
        <label>Название организации</Label>
        <input type="text" name="company_name" placeholder="Введите название вашей организации">
        <button  type="submit">Зарегистрироваться</button>
        <a href="/index.php">Назад</a>
        
    </form>
</body>
</html>