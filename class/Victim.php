<?php

/**
 * Created by PhpStorm.
 * User: Hubert Léo
 * Date: 19/04/2016
 * Time: 04:40
 */

include_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/class/Session.php';

if (isset($_POST["action"]))
{
    switch ($_POST["action"])
    {
        case "addVict":
            $victime = new Victim($apiUrl);
            Session::start();
            $victime->addVict();
            break;
        case "editVict":
            $victime = new Victim($apiUrl);
            Session::start();
            $victime->editVict();
            break;
    }
}

class Victim
{
    private static $apiUrl;
    private static $isInit;

    function __construct($apiUrl)
    {
        self::$apiUrl = $apiUrl;
        self::$isInit = 1;
    }

   public static function addVict()
   {
       if (isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['genre']) && isset($_POST['age']) &&
           isset($_POST['nombre']) && isset($_POST['phone']) && isset($_POST['commentaire']) && self::$isInit == 1)
       {
           $url = self::$apiUrl . "addVict.php";
           $fields = array(
               'token' => urlencode($_SESSION['token']),
               'nom' => urlencode($_POST['lastname']),
               'prenom' => urlencode($_POST['firstname']),
               'nombre' => urlencode($_POST['nombre']),
               'age' => urlencode($_POST['age']),
               'genre' => urlencode($_POST['genre']),
               'telephone' => urlencode($_POST['phone']),
               'commentaire' => urlencode($_POST['commentaire'])
           );

           /** @var Lanch request $json */
           $json = self::request($url, $fields);

           /** Redirect */
           header ("location: /admin/victim/add.php?msg=". $json->{'msg'}."&code=".$json->{'status'});
           exit();
       }
       header ("location: /admin/victim/add.php?msg=Error&code=404");
   }

    public static function editVict()
    {
        if (self::$isInit == 1)
        {
            $url = self::$apiUrl . "addVict.php";
            $fields = array(
                'token' => urlencode($_SESSION['token']),
                'token' => urlencode($_POST['token_vict']),
                'nom' => urlencode($_POST['lastname']),
                'prenom' => urlencode($_POST['firstname']),
                'nombre' => urlencode($_POST['nombre']),
                'age' => urlencode($_POST['age']),
                'genre' => urlencode($_POST['genre']),
                'telephone' => urlencode($_POST['phone']),
                'commentaire' => urlencode($_POST['commentaire'])
            );

            /** @var Lanch request $json */
            $json = self::request($url, $fields);

            /** Redirect */
            header ("location: /admin/victim/edit.php?victToken=". $_POST['token_vict']."&msg=".$json->{'msg'}."&code=". $json->{'status'});
            exit();
        }
        header ("location: /admin/victim/edit.php?msg=Error&code=404");
    }

    public static function getVictInfo($victToken, $search)
    {
        if (isset($_SESSION['token']) && self::$isInit == 1)
        {
            $url = self::$apiUrl . "getVictInfo.php";
            $fields = array(
                'token' => urlencode($_SESSION['token']),
                'token_vict' => urlencode($victToken)
            );

            /** @var Lanch request $json */
            $json = self::request($url, $fields);

            /** Return victim info */
            return $json->{$search};
        }
        return (false);
    }

    public static function getVictLocalised()
    {
        if (isset($_SESSION['token']) && self::$isInit == 1)
        {
            $url = self::$apiUrl . "getVictLocalised.php";
            $fields = array(
                'token' => urlencode($_SESSION['token'])
            );

            /** @var Lanch request $json */
            $json = self::request($url, $fields);

            /** @var Show result $i */
            $i = '0';
            $max = $json->{'taille'};
            while ($i < $max)
            {
                echo '<tr>
                        <td>'.self::getVictInfo($json->{$i}, "nom").'</td>
                        <td>'.self::getVictInfo($json->{$i}, "prenom").'</td>
                        <td>'.self::getVictInfo($json->{$i}, "telephone").'</td>
                        <td>'.self::getVictInfo($json->{$i}, "age").'</td>';
                if (self::getVictInfo($json->{$i}, "genre") == "0")
                    echo '<td>Homme</td>';
                else
                    echo '<td>Femme</td>';
                echo '<td><a href="/admin/victim/edit.php?victToken=' .$json->{$i}.'"><span class="glyphicon glyphicon-pencil"></span></a></td></tr>';
                $i++;
            }
        }
        return (false);
    }

    public static function getVictNotLocalised()
    {
        if (isset($_SESSION['token']) && self::$isInit == 1)
        {
            $url = self::$apiUrl . "getVictNotLocalised.php";
            $fields = array(
                'token' => urlencode($_SESSION['token'])
            );

            /** @var Lanch request $json */
            $json = self::request($url, $fields);

            /** @var Show result of request $i */
            $i = '0';
            $max = $json->{'taille'};
            while ($i < $max)
            {
                echo '<tr>
                        <td>'.self::getVictInfo($json->{$i}, "nom").'</td>
                        <td>'.self::getVictInfo($json->{$i}, "prenom").'</td>
                        <td>'.self::getVictInfo($json->{$i}, "telephone").'</td>
                        <td>'.self::getVictInfo($json->{$i}, "age").'</td>';
                if (self::getVictInfo($json->{$i}, "genre") == "0")
                    echo '<td>Homme</td>';
                else
                    echo '<td>Femme</td>';
                echo '<td><a href="/admin/victim/edit.php?victToken=' .$json->{$i}.'"><span class="glyphicon glyphicon-pencil"></span></a></td></tr>';
                $i++;
            }
        }
        return (false);
    }

    public static function getAllVict()
    {
        if (isset($_SESSION['token']) && self::$isInit == 1)
        {
            $url = self::$apiUrl . "getAllVict.php";
            $fields = array(
                'token' => urlencode($_SESSION['token'])
            );

            /** @var Lanch request $json */
            $json = self::request($url, $fields);

            /** @var Show result of request $i */
            $i = '0';
            $max = $json->{'taille'};
            while ($i < $max)
            {
                echo '<tr>
                        <td>'.self::getVictInfo($json->{$i}, "nom").'</td>
                        <td>'.self::getVictInfo($json->{$i}, "prenom").'</td>
                        <td>'.self::getVictInfo($json->{$i}, "telephone").'</td>
                        <td>'.self::getVictInfo($json->{$i}, "age").'</td>';
                if (self::getVictInfo($json->{$i}, "genre") == "0")
                    echo '<td>Homme</td>';
                else
                    echo '<td>Femme</td>';
                $state = self::getVictInfo($json->{$i}, "traitement"); //Etat de la prise en charge de la victime;  0 = Non localisé ; 1 = Localisé; 2 = Pris en charge
                if ($state == "0")
                    echo '<td><font color="red">Non localisé</font></td>';
                else if ($state == "1")
                    echo '<td><font color="green">Localisé</font></td>';
                else
                    echo '<td><font color="blue">Pris en charge</font></td>';
                echo '<td><a href="/admin/victim/edit.php?victToken=' .$json->{$i}.'"><span class="glyphicon glyphicon-pencil"></span></a></td></tr>';
                $i++;
            }
        }
        return (false);
    }

    public static function getOnlineUsers()
    {
        if (isset($_SESSION['token']) && self::$isInit == 1)
        {
            $url = self::$apiUrl . "countOnline.php";
            $fields = array(
                'token' => urlencode($_SESSION['token'])
            );

            /** @var Lanch request $json */
            $json = self::request($url, $fields);

            /** Return number of online member */
            return $json->{'nbr'};
        }
        return ('0');
    }

    public static function getNbrLocalised()
    {
        if (isset($_SESSION['token']) && self::$isInit == 1)
        {
            $url = self::$apiUrl . "countLocalised.php";
            $fields = array(
                'token' => urlencode($_SESSION['token'])
            );

            /** @var Lanch request $json */
            $json = self::request($url, $fields);

            /** Return number of localised victim */
            return $json->{'nbr'};
        }
        return ('0');
    }

    public static function getNbrNotLocalised()
    {
        if (isset($_SESSION['token']) && self::$isInit == 1)
        {
            $url = self::$apiUrl . "countNotLocalised.php";
            $fields = array(
                'token' => urlencode($_SESSION['token'])
            );

            /** @var Lanch request $json */
            $json = self::request($url, $fields);

            /** Return number of not localised victim */
            return $json->{'nbr'};
        }
        return ('0');
    }

    function request($url, $fields)
    {
        $fields_string = "";

        //url-ify the data for the POST
        foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
        rtrim($fields_string, '&');

        //open connection
        $ch = curl_init();

        //set the url, number of POST vars, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_POST, count($fields));
        curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        //execute post
        $result = curl_exec($ch);
        return (json_decode($result));
    }
}