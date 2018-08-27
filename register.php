<?php
session_start();

$first_name = '';
$last_name = '';
$password = '';

require_once("dbconnect.php");

if (isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])) {


    if (isset($_POST["name"])) {

        $first_name = trim($_POST["name"]);

        if (!empty($first_name)) {
            $first_name = htmlspecialchars($first_name, ENT_QUOTES);
        }

    }


    if (isset($_POST["last_name"])) {

        $last_name = trim($_POST["last_name"]);

        if (!empty($last_name)) {
            $last_name = htmlspecialchars($last_name, ENT_QUOTES);
        }


    }


    if (isset($_POST["email"])) {

        $email = trim($_POST["email"]);

        if (!empty($email)) {


            $email = htmlspecialchars($email, ENT_QUOTES);

            $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";

            if (!preg_match($reg_email, $email)) {

                header("HTTP/1.1 301 Moved Permanently");
                header("Location: " . $address_site . "/form_register.php");

                exit();
            }

        }

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

    

    

