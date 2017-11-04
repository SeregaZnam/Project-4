<?php
    header('Content-type: text/html; charset=utf-8');
    require('../classes/formBuild.php');
    require('../classes/databaseConnect.php');

    $db = new databaseConnect();
    //Если форма отправлена и пароль из формы совпадает с паролем в файле...
    if (!empty($_REQUEST['nickname'] ) and !empty($_REQUEST['password'])) {
        $nickname = $_REQUEST['nickname'];
        $password = md5($_REQUEST['password']);
        $condition = "nickname='".$nickname."' AND password='".$password."'";
        if($db -> get(registryPeople, $condition)){
            session_start();
            $_SESSION['auth'] = true;
            header('Location: main-window.php');
        } else {
            echo 'Неверные данные!';
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
    <link rel="stylesheet" href="css/main.min.css">
</head>
<body>
<?php
    $form = new formBuild();
    echo $form->open(['action' => '#', 'method' => 'POST']);
    echo $form->input(['type' => 'text', 'placeholder' => 'Никнейм', 'name' => 'nickname']);
    echo $form->input(['type' => 'password', 'placeholder' => 'Пароль', 'name' => 'password']);
    echo $form->submit(['value' => 'Войти']);
    echo $form->close();
?>
</body>
</html>
