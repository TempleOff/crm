<!DOCTYPE html>
<html lang="rus">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>
    <link rel="stylesheet" href="assets/css/style_main.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/purecss@3.0.0/build/pure-min.css" integrity="sha384-X38yfunGUhNzHpBaEBsWLO+A0HDYOQi8ufWDkZ0k9e0eXz/tH3II7uKZ9msv++Ls" crossorigin="anonymous">
</head>
    
<body>
    <header>
        <ul>
            <li><?php echo ($company_name);?></li>
            <li><a href="#" onclick="roles()">Сотрудники</a></li>
            <li><a href="#" onclick="clients()">Клиенты</a></li>
            <li><a href="#" onclick="history()">История</a></li>
            <li><a href="#" onclick="reports()">Отчеты</a></li>
            <li><a href="vendor/exit.php">Выход</a></li>
            
        </ul>
    </header>