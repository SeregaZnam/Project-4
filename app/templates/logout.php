<?php
    session_start(); //стартуем сессию, иначе будет ошибка при попытке разрушить
    session_destroy(); //разрушаем сессию для пользователя
    header('Location: ../index.php');
?>