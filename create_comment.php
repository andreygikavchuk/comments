<?php
require_once("dbconnect.php");


$first_name = '';
$comment_text = '';
$email = '';
$file_url = '';
$uploaddir = 'uploads/';
$date = date("dmYHis");
$file_url = 'user.png';
$data = array();
if (isset($_FILES)) {

    $error = false;
    $files = array();

    $uploaddir = 'uploads/';
    foreach ($_FILES as $file) {
        $original_name = $file["name"];

        $extension = pathinfo($original_name, PATHINFO_EXTENSION);

        $file_url = $uploaddir . basename($date . '.' . $extension);

        if (move_uploaded_file($file['tmp_name'], $file_url)) {
            $files[] = $uploaddir . $file['name'];
        } else {
            $error = true;
        }
    }
}


if (isset($_POST["action"]) && !empty($_POST["action"])) {
    if (isset($_POST["name"])) {
        $first_name = trim($_POST["name"]);
        if (!empty($first_name)) {
            $first_name = htmlspecialchars($first_name, ENT_QUOTES);
        }

    }

    if (isset($_POST["comment_text"])) {
        $comment_text = trim($_POST["comment_text"]);
        if (!empty($comment_text)) {
            $comment_text = htmlspecialchars($comment_text, ENT_QUOTES);
        }


    }

    if (isset($_POST["email"])) {

        $email = trim($_POST["email"]);

        if (!empty($email)) {


            $email = htmlspecialchars($email, ENT_QUOTES);

            $reg_email = "/^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i";



        }

    }


    $data = array();
    $data['author_name'] = $first_name;
    $data['author_email'] = $email;
    $data['comment_text'] = $comment_text;
    $data['author_photo'] = $file_url;
    $data['comment_status'] = 'draft';


    try {
        $db->Insert($data, 'comments');

    } catch (Exception $e) {
        exit($e->getMessage());
    }
    $db->Close();


    echo json_encode($data);
}







