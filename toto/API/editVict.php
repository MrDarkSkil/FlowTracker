<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 19/04/2016
 * Time: 12:20
 */

include "config.php";

if (isset($_POST['token']) && isset($_POST['token_vict']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['nombre'])
    && isset($_POST['telephone']) && isset($_POST['commentaire']) && isset($_POST['age']) && isset($_POST['genre']))
{
    $token = $_POST['token'];
    $requete = $db_trak->prepare('SELECT * FROM session WHERE `token` = :token');
    $requete->bindParam(':token', $token, PDO::PARAM_STR);
    $requete->execute();
    $reponse = $requete->fetch();
    $id = $reponse['user_id'];
    if ($requete->rowCount() != 0)
    {
        $requete = $db_trak->prepare('UPDATE `victime` SET `nom`=:nom,`prenom`=:prenom,`nombre`=:nombre,`age`=:age,
`genre`=:genre,`telephone`=:telephone,`id_creator`=:id, `commentaire`=:commentaire WHERE `token`=:token');
        $requete->execute(array(
            ':token' => $_POST['token_vict'],
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':nombre' => $_POST['nombre'],
            ':age' => $_POST['age'],
            ':genre' => $_POST['genre'],
            ':telephone' => $_POST['telephone'],
            ':commentaire' => $_POST['commentaire'],
            ':id' => $id));
        $arr = array('status' => 42, 'msg' => "Victime edite !");
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