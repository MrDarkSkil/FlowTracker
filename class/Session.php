<?php


include $_SERVER['DOCUMENT_ROOT'] . '/config/config.php';
require $_SERVER['DOCUMENT_ROOT'] . '/class/Mail.php';

if (isset($_POST['action']))
{
    switch ($_POST['action'])
    {
        case 'logIn':
            $session = new Session($apiUrl);
            $session->start();
            $session->logIn();
            break;
        case 'register':
            $session = new Session($apiUrl);
            $session->start();
            break;
        default:
            break;
    }
}

if (isset($_GET['action']))
{
    switch ($_GET['action'])
    {
        case 'logOut':
            $session = new Session($apiUrl);
            $session->start();
            $session->logOut();
            break;
        default:
            break;
    }
}


class Session
{
    private static $_sessionStarted = false;
    private static $api_url;

    function __construct($api_url)
    {
        self::$api_url = $api_url;
    }

    public static function start()
    {
        if (self::$_sessionStarted == false)
        {
            session_start();
            self::$_sessionStarted = true;
        }
    }

    public static function logOut()
    {
        if (self::$_sessionStarted == true && isset($_SESSION['token']))
        {
            /** @var Init request fields $fields */
            $fields = array(
                'token' => urlencode($_SESSION['token'])
            );

            /** @var Lanch request $json */
            $json = self::request(self::$api_url . "logout.php", $fields);

            /** Disconnect session */
            session_destroy();
            header ("location: /session/login.php?msg=".$json->{'msg'}."&code=".$json->{'status'});
        }
        header ("location: /index.php");
    }

    public static function isConnected()
    {
        if (self::$_sessionStarted == true && isset($_SESSION['token']))
        {
                /** @var Init request fields $fields */
                $fields = array(
                    'token' => urlencode($_SESSION['token'])
                );

                /** @var Lanch request $json */
                $json = self::request(self::$api_url . "isConnected.php", $fields);
                /** Check status request response */
                if ($json->{'status'} == "42")
                    return (true);  /** You are connected */
                else
                {
                    self::logOut(); /** Session Timed Out */
                    return (false);
                }
        }
        return (false);
    }

    public static function logIn()
    {
        if (isset($_POST['email']) && isset($_POST['password']) && self::$_sessionStarted == true) {

            /** @var Init request fields $fields */
            $fields = array(
                'email' => urlencode($_POST['email']),
                'password' => urlencode($_POST['password'])
            );

            /** @var Lanch request $json */
            $json = self::request(self::$api_url . "login.php", $fields);

            /** Check status request response */
            if ($json->{'status'} == "42")
                $_SESSION['token'] = $json->{'token'};
            header ("location: /session/login.php?msg=".$json->{'msg'}."&code=".$json->{'status'});
            exit();
        }
    }

    public static function getSessionInfo($search)
    {
        if (self::$_sessionStarted == true && self::isConnected() == true)
        {
            /** @var Init request fields $fields */
            $fields = array(
                'token' => urlencode($_SESSION['token'])
            );

            /** @var Lanch request $json */
            $json = self::request(self::$api_url . "getSessionInfo.php", $fields);
            return $json->{$search};
        }
        return (false);
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