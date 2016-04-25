<?php
/**
 * Created by PhpStorm.
 * User: Hubert Léo
 * Date: 18/04/2016
 * Time: 22:33
 */


/** @var General settings $webDir */

$webDir = $_SERVER['DOCUMENT_ROOT'];
$apiUrl = "http://hackathon.emodyz.com/API/"; /** Lien de l'API */
$adminFolder = $webDir . "/admin"; /** Destination du panel admin  */
$classFolder = $webDir . "/class"; /** Destination du dossier de class */
$serviceName = "Gendarmerie National";

/** END General settings */



/** SQL Connexion settings */

$db_host = "localhost";
$db_user = "root";
$db_pass = "epitech42";

/** END SQL settings */



/** Email send options */

$email_adress = "support@emodyz.com";       //SMTP Email
$email_pass = "20071997";                   //SMTP Pass
$email_smtp = "mx1.hostinger.fr";           //SMTP host
$email_port = 587;                          //Port SMTP


/** END Email send */