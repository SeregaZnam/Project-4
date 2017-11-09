<?php
    header('Content-type: text/html; charset=utf-8');
    require('../classes/databaseConnect.php');
    session_start(); //стартуем сессию

    $db = new databaseConnect();


    // Условие для выполнения обновления данных таски в БД
    if(
        !empty($_REQUEST['id']) and
        !empty($_REQUEST['title']) and
        !empty($_REQUEST['text'])
    ){
        // Необходимо вставить id контента
        $query = "UPDATE cardsContent SET title='".$_REQUEST['title']."', text='".$_REQUEST['text']."' WHERE id_content='".$_SESSION['id_content']."' AND id='".$_REQUEST['id']."'";
        $db -> update($query);
        header('Location: main-window.php');
    }

    // Условие для добавления таски в БД
    if(
        !empty($_REQUEST['title_insert']) and
        !empty($_REQUEST['text_insert'])
    ){
        $addedData = ['id_content' => $_SESSION['id_content'], 'title' => $_REQUEST['title_insert'], 'text' => $_REQUEST['text_insert']];
        $db -> save(cardsContent, $addedData);
        header('Location: main-window.php');
    }

    // Удаление такси из БД
    if( 
        !empty($_REQUEST['delete']) and
        !empty($_REQUEST['id'])
    ){
        $query = "DELETE FROM cardsContent WHERE id=".$_REQUEST['id'];
        $db -> delete($query);
        header('Location: main-window.php');
    }


    //Если переменная auth из сессии не пуста и равна true, то дадим доступ:
    if (!empty($_SESSION['auth']) and $_SESSION['auth']) {

        // Получение данных для данного пользователя
        $condition = 'id_content='.$_SESSION['id_content'];
        $data = $db -> get(cardsContent, $condition);
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
            <li><a class="waves-effect waves-light modal-trigger" href="#modal__insert">Create new task</a></li>
        </ul>
        <a href="#" data-activates="slide-out" class="button-collapse registration_btn waves-effect waves-light btn">menu</a>

        <div id="modal__insert" class="modal modal-fixed-footer">
            <form action="" method="GET">
                <div class="modal-content">
                  <h4><input type="text" name="title_insert"></h4>
                  <textarea name="text_insert" class="modal__content"></textarea>
                </div>
                <div class="modal-footer">
                <input type="submit" value="Add Task" class="modal-action modal-close waves-effect waves-green btn-flat">
                  <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                </div>
            </form>
        </div>

        <div class="cards__block">

            <?php 
                for($i = 0; $i < count($data); $i++):
            ?>
                <div class="cards__block_one">
                    <div class="cards__block_header"><?php echo $data[$i]['title']; ?></div>
                    <div class="cards__block_date"><?php echo $data[$i]['datatime']; ?></div>
                    <textarea class="cards__block_content" disabled><?php echo $data[$i]['text']; ?></textarea>
                    <div class="cards__block_button">
                        <a class="waves-effect waves-light btn modal-trigger" href="#modalr_<?php echo $i; ?>"">Read</a>
                        <a class="waves-effect waves-light btn modal-trigger" href="#modal_<?php echo $i; ?>">Edit</a>
                        <a class="waves-effect waves-light btn modal-trigger" href="main-window.php?delete=true&id=<?php echo $data[$i]['id']; ?>">Delete</a>
                    </div>
                </div>

                <!-- Модальное окно для редактирования -->
                <div id="modal_<?php echo $i; ?>" class="modal modal-fixed-footer">
                    <form action="" method="GET">
                        <div class="modal-content">
                          <input type="text" name="id" class="modal__id" value="<?php echo $data[$i]['id']; ?>">
                          <h4><input type="text" name="title" value="<?php echo $data[$i]['title']; ?>"></h4>
                          <textarea name="text" class="modal__content"><?php echo $data[$i]['text']; ?></textarea>
                        </div>
                        <div class="modal-footer">
                        <input type="submit" value="Edit" class="modal-action modal-close waves-effect waves-green btn-flat">
                        </div>
                    </form>
                </div>

                <!-- Модальное окно для чтения -->
                <div id="modalr_<?php echo $i; ?>" class="modal modal-fixed-footer">
                    <form action="" method="GET">
                        <div class="modal-content">
                          <h4><?php echo $data[$i]['title']; ?></h4>
                          <textarea class="modalr_text" disabled><?php echo $data[$i]['text']; ?></textarea>
                        </div>
                        <div class="modal-footer">
                          <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
                        </div>
                    </form>
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
    } else header('Location: authorization.php');
?>