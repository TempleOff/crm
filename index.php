<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
</head>
<body>
    <form action="vendor/authorization.php" method="post" autocomplete="off">
        <h1>CRM-system</h1>
        <label>Логин</label>
        <input name="login" type="text" placeholder="Введите имя"required>
        <br>
        <label>Пароль</label>
        <input name="password" type="password" placeholder="Введите пароль"required>
        <br>
        <label>Название организации</Label>
        <input name="company_name" type="text" placeholder="Введите название организации"required>
        <br>
        <button>Вход</button>
        <a href="/register.php">Регистрация</a>
    </form>
</body>
</html>