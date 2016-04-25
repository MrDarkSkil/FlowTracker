<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 20/04/2016
 * Time: 03:36
 */

include "config.php";

if (isset($_POST['token']) && isset($_POST['token_vict']))
{
    $token = $_POST['token'];
    $requete = $db_trak->prepare('SELECT * FROM session WHERE `token` = :token');
    $requete->bindParam(':token', $token, PDO::PARAM_STR);
    $requete->execute();
    if ($requete->rowCount() != 0)
    {
        $requete = $db_trak->prepare('SELECT * FROM victime WHERE `traitement` = 1');
        $requete->execute();
        $arr = array('status' => 42, 'msg' => "Voici la liste !", 'taille' => $requete->rowCount());
        $i = 0;
        while ($reponse = $requete->fetch())
        {
            $arr[$i] =  $reponse['token'];
            $i++;
        }
    }
    else
    {
        $arr = array('status' => 202, 'msg' => "Mauvais token !");
    }
}
else
{
    $arr = array('status' => 404, 'msg' => "Il manque des parametres !");
}
echo json_encode($arr);