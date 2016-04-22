<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 18/04/2016
 * Time: 23:47
 */

include "config.php";

if (isset($_POST['token']))
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
        $arr = array('status' => 42, 'msg' => "Donnees suivantes !", 'email' => $reponse['email'],
            'grade' => $reponse['grade'], 'nom' => $reponse['nom'], 'prenom' => $reponse['prenom'],
            'image' => $reponse['image']);
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