<!DOCTYPE html>
<html>
<!--Page d'accueil -->
<?php
$navigatorLanguage = explode(',',$_SERVER['HTTP_ACCEPT_LANGUAGE']);
$navigatorLanguage = strtolower(substr(chop($navigatorLanguage[0]),0,2));
if ($navigatorLanguage == "fr") 
 	include("fr.php");
if ($navigatorLanguage == "en")
	include("en.php");
?>