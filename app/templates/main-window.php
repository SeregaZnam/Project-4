<?php
    header('Content-type: text/html; charset=utf-8');
    require('../classes/databaseConnect.php');
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
    <link rel="stylesheet" href="../css/main.min.css">
    <link rel="stylesheet" href="../css/materialize.min.css">
</head>
<body>
    <div class="main-window">
        <nav>
          <div class="nav-wrapper">
            <a href="../index.php" class="brand-logo">Logo</a>
            <ul class="right hide-on-med-and-down">
              <li><a href="logout.php" class="registration_btn waves-effect waves-light btn">Exit</a></li>
            </ul>
          </div>
        </nav>

        <ul id="slide-out" class="side-nav">
            <li><div class="user-view">
              <div class="background">
                <img src="../img/office.png">
              </div>
              <a href="#!user"><img class="circle" src="../img/1.png"></a>
              <a href="#!name"><span class="white-text name"><?php echo $_SESSION['nickname'];?></span></a>
              <a href="#!email"><span class="white-text email"><?php echo $_SESSION['email']; ?></span></a>
            </div></li>
            <li><a href="#!"><i class="material-icons">cloud</i>First Link With Icon</a></li>
            <li><a href="#!">Second Link</a></li>
            <li><div class="divider"></div></li>
            <li><a class="subheader">Subheader</a></li>
            <li><a class="waves-effect" href="#!">Third Link With Waves</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse registration_btn waves-effect waves-light btn">menu</a>

        <div id="modal1" class="modal modal-fixed-footer">
            <div class="modal-content">
              <h4>Modal Header</h4>
              <p>A bunch of text</p>
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
            </div>
        </div>

        <?php 
            $db = new databaseConnect();
            $condition = 'id_content='.$_SESSION['id_content'];
            $data = $db -> get(cardsContent, $condition);
        ?>

        <div class="cards__block">

            <?php 
                for($i = 0; $i < count($data); $i++):
            ?>
                <div class="cards__block_one">
                    <div class="cards__block_header"><?php echo $data[$i]['title']; ?></div>
                    <div class="cards__block_date"><?php echo $data[$i]['datatime']; ?></div>
                    <div class="cards__block_content"><?php echo $data[$i]['text']; ?></div>
                    <div class="cards__block_button">
                        <a class="waves-effect waves-light btn">button</a>
                        <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Modal</a>
                    </div>
                </div>
            <?php 
                endfor;
            ?>
        </div>

    </div>
    <script src="../libs/jquery-3.2.1.min.js"></script>
    <script src="../js/main.js"></script>
    <script>
        // Активация меню
        $(".button-collapse").sideNav();

        // Активация модального окна
        $(document).ready(function(){
            $('.modal').modal();
          });
    </script>
</body>
</html>
<?php
    } else echo 'Доступ запрещен!';
?>
