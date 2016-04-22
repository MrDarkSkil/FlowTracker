<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 18/04/2016
 * Time: 23:02
 */

include "config.php";

if (isset($_POST['token_vict']) && isset($_POST['latitude']) && isset($_POST['longitude']))
{
    $token = $_POST['token_vict'];
    $requete = $db_trak->prepare('SELECT * FROM victime WHERE `token` = :token');
    $requete->bindParam(':token', $token, PDO::PARAM_STR);
    $requete->execute();
    if ($requete->rowCount() != 0)
    {
        $requete = $db_trak->prepare('UPDATE victime SET `traitement` = "1", `latitude` = :lati, `longitude` = :long,
                                      `hauteur` = :haut, `vitesse` = :vite, `accuracy` = :accu WHERE `token` = :token');
        $requete->execute(array(
            ':token' => $token,
            ':vite' => $_POST['vitesse'],
            ':long' => $_POST['longitude'],
            ':lati' => $_POST['latitude'],
            ':haut' => $_POST['altitude'],
            ':accu' => $_POST['accuracy']));
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