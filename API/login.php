<?php
/**
 * Created by PhpStorm.
 * User: Hubert Léo
 * Date: 10/04/2016
 * Time: 00:45
 */

include "config.php";

if (isset($_POST['email']) && isset($_POST['password']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $requete = $db_trak->prepare('SELECT * FROM user WHERE email = :email AND pwd= :pwd');
    $requete->bindParam(':email', $email, PDO::PARAM_STR);
    $requete->bindParam(':pwd', md5($password), PDO::PARAM_STR);
    $requete->execute();
    $reponse = $requete->fetch();

    if (md5($password) == $reponse['pwd'] && $email == $reponse['email'])
    {
        $requete = $db_trak->prepare('SELECT * FROM session WHERE user_id = :id');
        $requete->bindParam(':id', $reponse['id'], PDO::PARAM_STR);
        $requete->execute();
        $nbusr = $requete->rowCount();
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        if ($nbusr == 0)
        {
            $requete = $db_trak->prepare('INSERT INTO `session`(`token`, `user_id`, `id`) VALUES (:token,:user_id,"")');
            $requete->execute(array(
                ':token' => $token,
                ':user_id' => $reponse['id']
            ));
        }
        else
        {
            $requete = $db_trak->prepare('UPDATE `session` SET `token` = :token WHERE `user_id` = :id');
            $requete->execute(array(
                ':token' => $token,
                ':id' => $reponse['id']
            ));
        }
        $arr = array('status' => 42, 'token' => $token, 'msg' => "Connecte avec succes !");
    }
    else
    {
        $arr = array('status' => 202, 'token' => 'error', 'msg' => "Mot de passe ou identifiant incorrect !");
    }
}
else
{
    $arr = array('status' => 404, 'token' => 'error', 'msg' => "Mot de passe ou identifiant manquant !");
}
echo json_encode($arr);