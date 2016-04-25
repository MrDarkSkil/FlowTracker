<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 20/04/2016
 * Time: 02:58
 */

include "config.php";

if (isset($_POST['token']) && isset($_POST['latitude']) && isset($_POST['longitude']))
{
    $token = $_POST['token'];
    $requete = $db_trak->prepare('SELECT * FROM sessionApp WHERE `token` = :token');
    $requete->bindParam(':token', $token, PDO::PARAM_STR);
    $requete->execute();
    if ($requete->rowCount() != 0)
    {
        $reponse = $requete->fetch();
        $requete = $db_trak->prepare('UPDATE aidants SET `latitude` = :lati, `longitude` = :long, WHERE `id` = :id');
        $requete->execute(array(
            ':id' => $treponse['user_id'],
            ':long' => $_POST['longitude'],
            ':lati' => $_POST['latitude']));
        $arr = array('status' => 42, 'msg' => "Position enregistree !");
    }
    else
    {
        $arr = array('status' => 402, 'msg' => "Mauvais token !");
    }
}
else
{
    $arr = array('status' => 404, 'msg' => "Il manque des parametres !");
}
echo json_encode($arr);