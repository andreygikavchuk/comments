<?php
session_start();

require_once("dbconnect.php");

if (isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])) {
    $email = trim($_POST["email"]);
    if (isset($_POST["email"])) {

        if (!empty($email)) {
            $email = htmlspecialchars($email, ENT_QUOTES);

            $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

            if (!preg_match($reg_email, $email)) {
                $_SESSION["error_messages"] .= "<p class='mesage_error' >Вы ввели неправильный email</p>";

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_auth.php");

                exit();
            }
        }


    }

    if (isset($_POST["password"])) {

        $password = trim($_POST["password"]);

        if (!empty($password)) {
            $password = htmlspecialchars($password, ENT_QUOTES);

            $password = md5($password . "top_secret");
        }

    }


    $result_query_select = $db->Select("SELECT * FROM `users` WHERE email = '" . $email . "' AND password = '" . $password . "'");


    if (!$result_query_select) {

        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $address_site . "/form_auth.php");

        exit();
    } else {

        if (count($result_query_select) == 1) {

            $_SESSION['email'] = $email;
            $_SESSION['password'] = $password;

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/index.php");

        } else {

            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_auth.php");

            exit();
        }
    }


} else {
    exit("<p><strong>Помилка!</strong></p>");
}