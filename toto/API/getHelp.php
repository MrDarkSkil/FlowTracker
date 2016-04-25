<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 20/04/2016
 * Time: 03:05
 */

include "config.php";

function distance($lat1, $lon1, $lat2, $lon2)
{
    //rayon de la terre
    $r = 6366;
    $lat1 = deg2rad($lat1);
    $lat2 = deg2rad($lat2);
    $lon1 = deg2rad($lon1);
    $lon2 = deg2rad($lon2);

    //calcul précis
    $dp= 2 * asin(sqrt(pow (sin(($lat1-$lat2)/2) , 2) + cos($lat1)*cos($lat2)* pow( sin(($lon1-$lon2)/2) , 2)));

    //sortie en km
    $d = $dp * $r;

    return $d;
}

if (isset($_POST['token']))
{
    $token = $_POST['token'];
    $requete = $db_trak->prepare('SELECT * FROM sessionApp WHERE `token` = :token');
    $requete->bindParam(':token', $token, PDO::PARAM_STR);
    $requete->execute();
    $reponse = $requete->fetch();
    if ($requete->rowCount() != 0)
    {
        $requete = $db_trak->prepare('SELECT * FROM aidants WHERE `id` = :id');
        $requete->bindParam(':id', $reponse['user_id'], PDO::PARAM_STR);
        $requete->execute();
        $reponse = $requete->fetch();
        $requete = $db_trak->prepare('SELECT token FROM victime WHERE `traitement` = 1 && `necessit` <= :profil');
        $requete->bindParam(':profil', $reponse['profil'], PDO::PARAM_STR);
        $requete->execute();
        $reponse = $requete->fetch();
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