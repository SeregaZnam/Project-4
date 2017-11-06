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
                //В БД хэшируем пароль с помощью функции md5
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
    <link rel="stylesheet" href="../css/main.min.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
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

    <div class="registration">
        <div class="registration__block">
            <div class="registration__block_header">
                New Account
            </div>
            <div class="registration__block_wrap">
                <form action="" method="GET" class="registration__form">
                    <div class="registration__form_name"><input type="text" name="name" placeholder="Name" value="<?php if(!empty($_SESSION['name'])) echo $_SESSION['name'];?>"></div>
                    <div class="registration__form_surname"><input type="text" name="surname" placeholder="Surname" value="<?php if(!empty($_SESSION['surname'])) echo $_SESSION['surname'];?>"></div>
                    <div class="registration__form_nickname"><input type="text" name="nickname" placeholder="Nickname" value="<?php if(!empty($_SESSION['nickname'])) echo $_SESSION['nickname'];?>"></div>
                    <div class="registration__form_password"><input type="password" name="password" placeholder="Password"></div>
                    <div class="registration__form_confpassword"><input type="password" name="confirm_password" placeholder="Confirm password"></div>
                    <div class="registration__form_email"><input type="text" name="email" placeholder="Email" value="<?php if(!empty($_SESSION['email'])) echo $_SESSION['email'];?>"></div>
                    <div class="registration__form_age"><input type="text" name="age" placeholder="Age" value="<?php if(!empty($_SESSION['age'])) echo $_SESSION['age'];?>"></div>
                    <!-- добавлен stopPropagation() для удаления искусственно созданных option при нажатии на другие части экрана -->
                    <div onclick="event.stopPropagation()" class="registration__form_male"><input id="registration__form_select" type="text" name="age" placeholder="What is your gender?"></div>
                    <input class="registration__form_submit btn btn-success" type="submit" value="Create Account">
                </form>
            </div>
        </div>
        </div>
    <script src="../libs/jquery-3.2.1.min.js"></script>
    <script src="../js/main.js"></script>
</body>
</html>
