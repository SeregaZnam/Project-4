<?php
    session_start();
    require("../classes/formBuild.php");
    require("../classes/databaseConnect.php");

    $db = new databaseConnect;

    if(
        !empty($_REQUEST['name']) and
        !empty($_REQUEST['surname']) and
        !empty($_REQUEST['nickname']) and
        !empty($_REQUEST['password']) and
        !empty($_REQUEST['confirm_password']) and
        !empty($_REQUEST['email']) and
        !empty($_REQUEST['male'])
    ){
        $_SESSION['name']     = $_REQUEST['name'];
        $_SESSION['surname']  = $_REQUEST['surname'];
        $_SESSION['nickname'] = $_REQUEST['nickname'];
        $_SESSION['email']    = $_REQUEST['email'];
        $_SESSION['age']      = $_REQUEST['age'];

        if($_REQUEST['password'] == $_REQUEST['confirm_password']) {
            //Проверяем что логин не занят
            $db = new databaseConnect();
            $condition = "nickname='".$_REQUEST['nickname']."'";
            if($db -> get(registryPeople, $condition)){
                echo 'Данный логин уже занят';
            } else {
                $db->save('registryPeople', ['name' => $_REQUEST['name'], 'surname' => $_REQUEST['surname'], 'nickname' => $_REQUEST['nickname'], 'password' => md5($_REQUEST['password']), 'email' => $_REQUEST['email'], 'male' => $_REQUEST['male']]);
                header('Location: authorization.php');
            }
        } else {
            echo 'Пароли не совпадают';
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="GET">
        <input type="text" name="name" placeholder="Имя" value="<?php if(!empty($_SESSION['name'])) echo $_SESSION['name'];?>">
        <input type="text" name="surname" placeholder="Фамилия" value="<?php if(!empty($_SESSION['surname'])) echo $_SESSION['surname'];?>">
        <input type="text" name="nickname" placeholder="Никнейм" value="<?php if(!empty($_SESSION['nickname'])) echo $_SESSION['nickname'];?>">
        <input type="password" name="password" placeholder="Пароль">
        <input type="password" name="confirm_password" placeholder="Подтвердите пароль">
        <input type="text" name="email" placeholder="email" value="<?php if(!empty($_SESSION['email'])) echo $_SESSION['email'];?>">
        <input type="text" name="age" placeholder="возраст" value="<?php if(!empty($_SESSION['age'])) echo $_SESSION['age'];?>">
    <select name="male">
        <option value="Мужской">Мужской</option>
        <option value="Женский">Женский</option>
    </select>
        <input type="submit" value="Отправить">
    </form>
</body>
</html>
