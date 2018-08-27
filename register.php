<?php
//Запускаем сессию
session_start();

$first_name = '';
$last_name = '';
$password = '';

//Добавляем файл подключения к БД
require_once("dbconnect.php");

//Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
$_SESSION["error_messages"] = '';

//Объявляем ячейку для добавления успешных сообщений
$_SESSION["success_messages"] = '';

/*
    Проверяем была ли отправлена форма, то есть была ли нажата кнопка зарегистрироваться. Если да, то идём дальше, если нет, значит пользователь зашёл на эту страницу напрямую. В этом случае выводим ему сообщение об ошибке.
*/
if (isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])) {


    if (isset($_POST["name"])) {

        //Обрезаем пробелы с начала и с конца строки
        $first_name = trim($_POST["name"]);

        //Проверяем переменную на пустоту
        if (!empty($first_name)) {
            // Для безопасности, преобразуем специальные символы в HTML-сущности
            $first_name = htmlspecialchars($first_name, ENT_QUOTES);
        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error'>Укажите Ваше имя</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //Останавливаем скрипт
            exit();
        }


    }


    if (isset($_POST["last_name"])) {

        //Обрезаем пробелы с начала и с конца строки
        $last_name = trim($_POST["last_name"]);

        //Проверяем переменную на пустоту
        if (!empty($last_name)) {
            // Для безопасности, преобразуем специальные символы в HTML-сущности
            $last_name = htmlspecialchars($last_name, ENT_QUOTES);
        }


    }


    if (isset($_POST["email"])) {

        //Обрезаем пробелы с начала и с конца строки
        $email = trim($_POST["email"]);

        if (!empty($email)) {


            $email = htmlspecialchars($email, ENT_QUOTES);

            // (3) Место кода для проверки формата почтового адреса и его уникальности

            //Проверяем формат полученного почтового адреса с помощью регулярного выражения
            $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

            //Если формат полученного почтового адреса не соответствует регулярному выражению
            if (!preg_match($reg_email, $email)) {
                // Сохраняем в сессию сообщение об ошибке.
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправельный email</p>";

                //Возвращаем пользователя на страницу регистрации
                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_register.php");

                //Останавливаем  скрипт
                exit();
            }

        } else {
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<p class='mesage_error' >Укажите Ваш email</p>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_register.php");

            //Останавливаем  скрипт
            exit();
        }

    } else {
        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<p class='mesage_error' >Отсутствует поле для ввода Email</p>";

        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $address_site . "/form_register.php");

        //Останавливаем  скрипт
        exit();
    }

    $password = md5($_POST['password'] . "top_secret");

    $data = array();
    $data['first_name'] = $first_name;
    $data['last_name'] = $last_name;
    $data['email'] = $email;
    $data['password'] = $password;


    try {
        $db->Insert($data, 'users');

        header("HTTP/1.1 301 Moved Permanently");
        header("Location: ".$address_site."/form_auth.php");

    } catch (Exception $e) {
        exit($e->getMessage());

    }
    $db->Close();


} else {

    exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=" . $address_site . "> главную страницу </a>.</p>");
}

    

    

