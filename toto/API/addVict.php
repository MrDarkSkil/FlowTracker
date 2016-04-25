<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 18/04/2016
 * Time: 22:03
 */

include "config.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/class/Mail.php";

if (isset($_POST['token']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['nombre'])
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
        $token = bin2hex(openssl_random_pseudo_bytes(16));
        sendClienToken("leohub@live.fr", $_POST['prenom'], $_POST['nom'], $token);
        $requete = $db_trak->prepare('INSERT INTO `victime`(`id`, `token`, `nom`, `prenom`, `nombre`, `age`, `genre`,
`telephone`, `id_creator`, `traitement`, `date`, `commentaire`)
VALUES ("",:token,:nom,:prenom,:nombre,:age,:genre,:telephone,:id,"0",:datee,:commentaire)');
        $requete->execute(array(
            ':token' => $token,
            ':nom' => $_POST['nom'],
            ':prenom' => $_POST['prenom'],
            ':nombre' => $_POST['nombre'],
            ':age' => $_POST['age'],
            ':genre' => $_POST['genre'],
            ':telephone' => $_POST['telephone'],
            ':datee' => date("h;i;d;m;Y"),
            ':commentaire' => $_POST['commentaire'] . "Lien de test: http://hackathon.emodyz.com/client/?token=" . $token,
            ':id' => $id));
        $arr = array('status' => 42, 'msg' => "Victime creee !");
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