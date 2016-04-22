<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 19/04/2016
 * Time: 18:20'email'
 */

include "config.php";

if (isset($_POST['token']) && isset($_POST['user_id']) && isset($_POST['email']) && isset($_POST['grade'])
    && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['image']))
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

            $requete = $db_trak->prepare('UPDATE `user` SET `email`=:email,`grade`=:grade,`nom`=:nom,`prenom`=:prenom,
                                        `image`=:image WHERE `id` = :id');
            $requete->execute(array(
                ':nom' => $_POST['nom'],
                ':prenom' => $_POST['prenom'],
                ':email' => $_POST['email'],
                ':grade' => $_POST['grade'],
                ':id' => $_POST['user_id'],
                ':image' => $_POST['image']));
            echo "Salut";
            $arr = array('status' => 42, 'msg' => "Compte edite!");
        }
        else
        {
            $arr = array('status' => 500, 'msg' => "Vous n'avez pas les droits d'acceder a cette information !");
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