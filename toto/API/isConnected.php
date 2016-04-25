<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 19/04/2016
 * Time: 21:50
 */

include "config.php";

if (isset($_POST['token']))
{
    $token = $_POST['token'];
    $requete = $db_trak->prepare('SELECT * FROM session WHERE `token` = :token');
    $requete->bindParam(':token', $token, PDO::PARAM_STR);
    $requete->execute();
    if ($requete->rowCount() != 0)
    {
        $arr = array('status' => 42, 'msg' => "Vous etes toujours connecte.");
    }
    else
    {
        $arr = array('status' => 202, 'msg' => "Session non existante !");
    }
}
else
{
    $arr = array('status' => 404, 'msg' => "Token manquant !");
}
echo json_encode($arr);