<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 19/04/2016
 * Time: 00:41
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
        $requete = $db_trak->prepare('SELECT token FROM victime WHERE `traitement` = 1');
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