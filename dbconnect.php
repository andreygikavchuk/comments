<?php
header('Content-Type: text/html; charset=utf-8');


include 'db.php';
$address_site = 'http://localhost:8888';
try {
    $db = new DB('localhost', 'root', 'root', 'test');

    $query = "CREATE TABLE IF NOT EXISTS `" . "comments`(";
    $query .= "`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
    $query .= "`author_name` VARCHAR(255) NOT NULL DEFAULT '',";
    $query .= "`author_email` VARCHAR(255) NOT NULL DEFAULT '',";
    $query .= "`comment_text` TEXT NOT NULL,";
    $query .= "`comment_status` VARCHAR(255) NOT NULL DEFAULT '',";
    $query .= "`author_photo` VARCHAR(255) NOT NULL DEFAULT '',";
    $query .= "`comment_date` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,";
    $query .= "PRIMARY KEY (`id`)) DEFAULT CHARSET=utf8;";
    $db->Query($query);

    $query = "CREATE TABLE IF NOT EXISTS `" . "users`(";
    $query .= "`id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,";
    $query .= "`first_name` VARCHAR(255) NOT NULL DEFAULT '',";
    $query .= "`last_name` VARCHAR(255) NOT NULL DEFAULT '',";
    $query .= "`email` VARCHAR(255) NOT NULL DEFAULT '',";
    $query .= "`password` VARCHAR(100) NOT NULL DEFAULT '',";
    $query .= "PRIMARY KEY (`id`)) DEFAULT CHARSET=utf8;";
    $db->Query($query);


} catch (Exception $e) {
    exit($e->getMessage());
}

