<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 18/04/2016
 * Time: 23:47
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
        $token = $_POST['token_vict'];
        $requete = $db_trak->prepare('SELECT * FROM victime WHERE `token` = :token');
        $requete->bindParam(':token', $token, PDO::PARAM_STR);
        $requete->execute();
        $reponse = $requete->fetch();
        if ($requete->rowCount() != 0)
        {
            $arr = array('status' => 42, 'msg' => "Donnees suivantes !", 'nom' => $reponse['nom'],
                'prenom' => $reponse['prenom'], 'nombre' => $reponse['nombre'], 'telephone' => $reponse['telephone'],
                'commentaire' => $reponse['commentaire'], 'id_creator' => $reponse['id_creator'], 'traitement' => $reponse['traitement'],
                'latitude' => $reponse['latitude'], 'longitude' => $reponse['longitude'], 'hauteur' => $reponse['hauteur'],
                'vitesse' => $reponse['vitesse'], 'age' => $reponse['age'], 'genre' => $reponse['genre']);
        }
        else
        {
            $arr = array('status' => 202, 'msg' => "Mauvais token victime !");
        }
    }
    else
    {
        $arr = array('status' => 203, 'msg' => "Mauvais token utilisateur !");
    }
}
else
{
    $arr = array('status' => 404, 'msg' => "Il manque des parametres !");
}
echo json_encode($arr);