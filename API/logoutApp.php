<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 20/04/2016
 * Time: 02:57
 */

include "config.php";

if (isset($_POST['token']))
{
    $token = $_POST['token'];
    $requete = $db_trak->prepare('DELETE FROM sessionApp WHERE `token` = :token');
    $requete->bindParam(':token', $token, PDO::PARAM_STR);
    $requete->execute();
    if ($requete->rowCount() != 0)
        $arr = array('status' => 41, 'msg' => "Deconnecte avec succes !");
    else
        $arr = array('status' => 202, 'msg' => "Session non existante !");
}
else
    $arr = array('status' => 404, 'msg' => "Token manquant !");
echo json_encode($arr);