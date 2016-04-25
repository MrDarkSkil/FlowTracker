<?php

/**
 * Created by PhpStorm.
 * User: Hubert Léo
 * Date: 18/04/2016
 * Time: 00:33
 */

require_once $_SERVER['DOCUMENT_ROOT'] . '/MailFramework/PHPMailerAutoload.php';

function sendClienToken($email, $name, $lastname, $token)
{
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Debugoutput = 'html';
    $mail->Host = "smtp.live.com";
    $mail->Port = 25;
    $mail->SMTPAuth = true;
    $mail->Username = "email@email.com";
    $mail->Password = "password";
    $mail->setFrom('email@email.com', 'FlowTracker');
    $mail->addAddress($email, $name . $lastname);
    $mail->Subject = '[FlowTracker] Lien de geolocalisation';
    $mail->Body    = 'Lien de confirmation: <a href="http://hackathon.emodyz.com/client/?token='. $token. '">http://hackathon.emodyz.com/client/?token='. $token .'</a>';
    $mail->AltBody = 'Lien de confirmation: <a href="http://hackathon.emodyz.com/client/?token='. $token. '">http://hackathon.emodyz.com/client/?token='. $token .'</a>';
    if (!$mail->send()) {
        header("location: /admin/victim/addVictim.php?msg=Erreur d'envoi de mail !&code=404");
    }
}