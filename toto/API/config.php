<?php
/**
 * Created by PhpStorm.
 * User: Hubert Léo
 * Date: 10/04/2016
 * Time: 00:41
 */

include $_SERVER['DOCUMENT_ROOT'] . "/config/config.php";

try {
    $db_trak = new PDO("mysql:host=$db_host;dbname=flowtraker", $db_user, $db_pass);
    $db_trak->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "Connection failed: " . $e->getMessage();
    die;
}