<?php
    header('Content-type: text/html; charset=utf-8');
    require('../classes/formBuild.php');
    require('../classes/databaseConnect.php');

    $db = new databaseConnect();
    // $condition = "nickname='".$nickname."' AND password='".$password."'";
    // var_dump($db -> get(registryPeople, $condition));
    //Если форма отправлена и пароль из формы совпадает с паролем в файле...
    if (!empty($_REQUEST['nickname'] ) and !empty($_REQUEST['password'])) {
        $nickname = $_REQUEST['nickname'];
        $password = md5($_REQUEST['password']);
        $condition = "nickname='".$nickname."' AND password='".$password."'";
        if($db -> get(registryPeople, $condition)){

            // Создаем запрос для получения значения id_content для авторизованного пользователя
            $id_content = $db -> get(registryPeople, $condition);

            session_start();
            $_SESSION['auth'] = true;
            $_SESSION['nickname'] = $nickname;
            $_SESSION['email'] = $id_content[0]['email'];
            // Сохраняем полученно значение id_content в сессию
            $_SESSION['id_content'] = $id_content[0]['id_content'];


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
    <link rel="stylesheet" href="../css/main.min.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
    <script src="../libs/bootstrap.min.js"></script>
</head>
<body>

    <nav>
      <div class="nav-wrapper">
        <a href="../index.php" class="brand-logo">Logo</a>
        <ul class="right hide-on-med-and-down">
          <li><a href="authorization.php" class="registration_btn waves-effect waves-light btn">Sign In</a></li>
          <li><a href="registration.php" class="registration_btn waves-effect waves-light btn">Sign Up</a></li>
        </ul>
      </div>
    </nav>
    <div class="authorization">
        <div class="authorization__block">
            <div class="authorization__block_header">
                Authorization
            </div>
            <div class="authorization__block_wrap">
                <?php
                    $form = new formBuild();
                    echo $form->open(['action' => '#', 'method' => 'POST']);
                    echo $form->input(['type' => 'text', 'placeholder' => 'Nickname', 'name' => 'nickname']);
                    echo $form->input(['type' => 'password', 'placeholder' => 'Password', 'name' => 'password']);
                    echo $form->submit(['value' => 'Submit', 'class' => '"authorization__form_submit btn waves-effect waves-light"']);
                    echo $form->close();
                ?>
            </div>
        </div>
    </div>
    <script src="libs/jquery-3.2.1.min.js"></script>
    <script src="../libs/materialize.min.js"></script>
</body>
</html>
