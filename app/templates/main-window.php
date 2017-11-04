<?php
    header('Content-type: text/html; charset=utf-8');
    session_start(); //стартуем сессию

    //Если переменная auth из сессии не пуста и равна true, то дадим доступ:
    if (!empty($_SESSION['auth']) and $_SESSION['auth']) {
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="css/main.min.css">
</head>
<body>
    <a href="logout.php">Выйти</a>
</body>
</html>
<?php
    } else echo 'Доступ запрещен!';
?>
