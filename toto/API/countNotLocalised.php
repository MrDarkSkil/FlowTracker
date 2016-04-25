<?php
/**
 * Created by PhpStorm.
 * User: leandr_g
 * Date: 20/04/2016
 * Time: 09:10
 */

include "config.php";

$requete = $db_trak->prepare('SELECT * FROM victime WHERE `traitement`=0');
$requete->execute();
$arr = array('status' => 42, 'nbr' => $requete->rowCount());
echo json_encode($arr);