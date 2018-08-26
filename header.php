<?php 
    //Запускаем сессию
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Название нашего сайта</title>
    <meta charset="utf-8" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script><link rel="stylesheet" type="text/css" href="css/styles.css">
    <script src="main.js"></script>
</head>
<body>

<header>



    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="/index.php">Головна</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">

                <?php
                //Проверяем авторизован ли пользователь
                if(!isset($_SESSION['email']) && !isset($_SESSION['password'])){
                    // если нет, то выводим блок с ссылками на страницу регистрации и авторизации
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="/form_register.php">Реєстрація</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="/form_auth.php">Авторизація</a>
                    </li>

                    <?php
                }else{
                    //Если пользователь авторизован, то выводим ссылку Выход
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/admin_page.php">Адмін панель</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/logout.php">Вихід</a>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </nav>
</header>
