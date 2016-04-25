<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 19/04/2016
 * Time: 19:22
 */

include "config.php";

if (isset($_POST['token']) && isset($_POST['user_id']))
{
    $token = $_POST['token'];
    $requete = $db_trak->prepare('SELECT * FROM session WHERE `token` = :token');
    $requete->bindParam(':token', $token, PDO::PARAM_STR);
    $requete->execute();
    $reponse = $requete->fetch();
    if ($requete->rowCount() != 0)
    {
        $id = $reponse['user_id'];
        $requete = $db_trak->prepare('SELECT * FROM user WHERE `id` = :id');
        $requete->bindParam(':id', $id, PDO::PARAM_STR);
        $requete->execute();
        $reponse = $requete->fetch();
        if ($reponse['grade'] == "1")
        {
            $requete = $db_trak->prepare('DELETE FROM `user` WHERE `id` = :id');
            $requete->bindParam(':id', $_POST['user_id'], PDO::PARAM_STR);
            $requete->execute();
            $arr = array('status' => 42, 'msg' => "Compte supprimé!");
        }
        else
        {
            $arr = array('status' => 500, 'msg' => "Vous n'avez pas les droits pour effectuer cette action !");
        }
    }
    else
    {
        $arr = array('status' => 202, 'msg' => "Mauvais token !");
    }
}
else
{
    $arr = array('status' => 402, 'msg' => "Il manque des parametres !");
}
echo json_encode($arr);