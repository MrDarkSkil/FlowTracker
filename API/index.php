<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="description" content="">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>FlowTracker | Doc API</title>
<link rel="alternate" type="application/rss+xml" title="frittt.com" href="feed/index.html">
<link href="http://fonts.googleapis.com/css?family=Raleway:700,300" rel="stylesheet"
        type="text/css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/prettify.css">
</head>
<body>
<div class="wrapper">
<nav>
 
  	<div class="pull-left">
    	<h1><a href="javascript:"><img src="img/icon.png" alt="FlowTracker" /> <span>API FlowTracker</span></a></h1>
    </div>

</nav>
<header>
  <div class="container">
    <h2 class="lone-header">FlowTracker API Documentation</h2>
  </div>
</header>
<section>
  <div class="container">
    <ul class="docs-nav">
      <li><strong>Préparation</strong></li>
      <li><a href="#welcome" class="cc-active">Présentation</a></li>
      <li class="separator"></li>
      <li><strong>L'API</strong></li>
      <li><a href="#session" class="cc-active">Session</a></li>
      <li><a href="#userinfo" class="cc-active">Information utilisateur</a></li>
      <li><a href="#list" class="cc-active">List</a></li>
      <li><a href="#edit" class="cc-active">Edition</a></li>
      <li><a href="#add" class="cc-active">Ajout</a></li>
      <li><a href="#localisation" class="cc-active">Localisation</a></li>
      <li><a href="#suppression" class="cc-active">Suppression</a></li>
      <li><a href="#stat" class="cc-active">Statistique</a></li>
    </ul>
    <div class="docs-content">
      <h2> FlowTracker Starter Pack</h2>
      <h3 id="welcome"> Bienvenue</h3>
      <p> Etes vous prêt à vous lancer dedans ?</p>
      
      <p> L’API est la base des requêtes du réseau FlowTracker. Chaque interaction possible est codée, de manière à protéger le
          plus possible les données sensibles. Grâce à cette documentation, n’importe quel développeur peut créer son application
          web, en communication avec le serveur principal.
          Pour des questions de sécurité, chaque session est authentifiée par un token de 16 caractères. Celui ci est généré
          aléatoirement pour les utilisateurs (comptes secours), les victimes (fiche suivi) et les civils (personnes proposant leur aide).</p>
      <hr>
      <h3 id="session"> Session</h3>
      <ul>
        <li>Connexion</li>
      </ul>
        <h1> Requete: <b>/login.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "email" : "blabla@flowtracker.com"<br> "password" : "motdepasse"</font></pre>
        En cas de réussite:
        <pre class="prettyprint">
            {
               "status":42,
               "token":"jifo98byfrfe34F3R3FEutr5",      //Identifiant de la session
               "msg":"Connecte avec succes !"
            }</pre>
        En cas de mauvais mot de passe:
      <pre class="prettyprint">
            {
               "status":202,
               "token":"error",
               "msg":"Mot de passe ou identifiant incorrect !"
            }</pre>
        En cas de champ manquant:
        <pre class="prettyprint">
            {
               "status":404,
               "token":"error",
               "msg":"Mot de passe ou identifiant manquant !"
            }</pre>
      <ul>
        <li>Déconnexion</li>
      </ul>
        <h1> Requete: <b>/logout.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"</font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
               "status":41,
               "msg":"Deconnecte avec succes !"
          }</pre>
        En cas de session non existante:
      <pre class="prettyprint">
          {
               "status":202,
               "msg":"Session non existante !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
               "status":404,
               "msg":"Token manquant !"
          }</pre>
        <ul>
            <li>Connexion status</li>
        </ul>
        <h1> Requete: <b>/isConnected.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"</font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
               "status":42,
               "msg":"Vous etes toujours connecte."
          }</pre>
        En cas de session non existante:
      <pre class="prettyprint">
          {
               "status":202,
               "msg":"Session non existante !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
               "status":404,
               "msg":"Token manquant !"
          }</pre>
        <hr>
      <h3 id="userinfo"> Information utilisateur</h3>
      <ul>
        <li>Récupérer les informations de son compte</li>
      </ul>
        <h1> Requete: <b>/getSessionInfo.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"</font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Donnees suivantes !",
                "email":"blabla@flowtracker.com",       //Email de l'utilisateur
                "grade":"0",                            //Grade de l'utilisateur
                "nom":"Tournesol",                      //Nom de l'utilisateur
                "prenom":"Jean",                        //Prenom de l'utilisateur
                "image":"/images/users/userid.png"      //Image de profil
          }</pre>
        En cas de mauvais token:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":402,
                "msg":"Il manque des parametres !"
          }</pre>
      <ul>
        <li>Récupéper les informations d'un autre utilisateur</li>
      </ul>
        <h1> Requete: <b>/getUserInfo.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"<br> "user_id" : "3"</font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Donnees suivantes !",
                "email":"blabla@flowtracker.com",       //Email de l'utilisateur
                "grade":"0",                            //Grade de l'utilisateur
                "nom":"Tournesol",                      //Nom de l'utilisateur
                "prenom":"Jean",                        //Prenom de l'utilisateur
                "image":"/images/users/userid.png"      //Image de profil
          }</pre>
        En cas de mauvais token:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token !"
          }</pre>
        En cas de permissions manquante:
      <pre class="prettyprint">
          {
                "status":500,
                "msg":"Vous n'avez pas les droits d'accèder à cette information !"
          }</pre>
        En cas d'utilisateur introuvable:
      <pre class="prettyprint">
          {
                "status":404,
                "msg":"Utilisateur inconnue !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":402,
                "msg":"Il manque des parametres !"
          }</pre>
      <ul>
        <li>Récupéper les informations d'une victime</li>
      </ul>
        <h1> Requete: <b>/getVictInfo.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"<br> "token_vict" : "uf4gr7547Dkhy24FEG34frg"</br></font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Donnees suivantes !",
                "nom":"Tournesol",                                  //Nom de la victime
                "prenom":"Jean",                                    //Prénom de la victime
                "nombre":"2",                                       //Nombres de personnes en danger
                "telephone":"+336123456789",                        //Numéro de téléphone
                "commentaire":"Saignement important à la tête.",    //Information complémentaire
                "id_creator":"2",                                   //User ID du gendarme qui à crée la fiche
                "traitement":"0",                                   // 0 = no localisé; 1 = localisé; 2 = terminée
                "latitude":"44.45335",                              //Latitude
                "longitude":"23.35635",                             //Longitude
                "hauteur":"24",                                     //Altitude
                "vitesse":"53",                                     //Vitesse de déplacement
                "age","23",                                         //Age de la personne en danger
                "genre","0"                                         //1 = Femme; 0 = Homme
          }</pre>
        En cas de mauvais token victime:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token victime !"
          }</pre>
        En cas de mauvais token utilisateur:
      <pre class="prettyprint">
          {
                "status":203,
                "msg":"Mauvais token utilisateur !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":404,
                "msg":"Il manque des parametres !"
          }</pre>
        <hr>
      <h3 id="list"> List</h3>
      <ul>
        <li>Récupérer la list des victimes qui ont été localisé.</li>
      </ul>
        <h1> Requete: <b>/getVictLocalised.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"</br></font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Donnees suivantes !",
                "taille":"2",                      //Nombre d'utilisateurs trouvé
                "0":"kopf97uigiFEGdiyGE5ih35id",   //User Token N°1
                "1":"lfkj3948jodiohFEF34GET3Sf"    //User Token N°2
          }</pre>
        En cas de mauvais token:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":404,
                "msg":"Il manque des parametres !"
          }</pre>
      <ul>
        <li>Récupérer la list des victimes qui n'ont pas été localisé</li>
      </ul>
        <h1> Requete: <b>/getVictNotLocalised.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"</br></font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Donnees suivantes !",
                "taille":"3",                      //Nombre d'utilisateurs trouvé
                "0":"kopf97uigiFEGdiyGE5ih35id",   //User Token N°1
                "1":"lfkj3948jodiohFEF34GET3Sf"    //User Token N°2
                "2":"9786BfgbFEUFEfeulg3UIduii"    //User Token N°3
          }</pre>
        En cas de mauvais token:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":404,
                "msg":"Il manque des parametres !"
          }</pre>
        <hr>
        <h3 id="edit"> Edit</h3>
        <ul>
            <li>Modifier les données d'un Utilisateur</li>
        </ul>
        <h1> Requete: <b>/editUser.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"
 "user_id" : "7"<br> "email" : "newemail@flowtracker.com"<br> "grade" : "2"
 "nom" : "Fromage" <br> "prenom" : "Michel"<br> "image" : "/images/users/userid.png"</br></font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Compte édité !"
          }</pre>
        En cas de mauvais token:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token !"
          }</pre>
        En cas de permissions manquante:
      <pre class="prettyprint">
          {
                "status":500,
                "msg":"Vous n'avez pas les droits d'acceder a cette information !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":404,
                "msg":"Il manque des parametres !"
          }</pre>
        <ul>
            <li>Modifier les données d'une victimes</li>
        </ul>
        <h1> Requete: <b>/editVict.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"
 "token_vict" : "jf8679Gfr35FEkoh8DBidf"<br> "nom" : "Fromage" <br> "prenom" : "Michel" <br> "nombre" : "3"<br> "telephone" : "+33472946294"
 "commentaire" : "Situation délicate /!\ Neige" <br> "age" : "17"<br> "genre" : "1"</br></font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Victime edite!"
          }</pre>
        En cas de mauvais token:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":404,
                "msg":"Il manque des parametres !"
          }</pre>
        <hr>
        <h3 id="add"> Ajout</h3>
        <ul>
            <li>Ajouter une Victime</li>
        </ul>
        <h1> Requete: <b>/addVict.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"
 "nom" : "Fromage" <br> "prenom" : "Michel" <br> "nombre" : "3"<br> "telephone" : "+33472946294"
 "commentaire" : "Situation délicate /!\ Neige" <br> "age" : "17"<br> "genre" : "1"</br></font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Victime creee!"
          }</pre>
        En cas de mauvais token:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":404,
                "msg":"Il manque des parametres !"
          }</pre>
        <hr>
        <h3 id="localisation"> Localisation</h3>
        <ul>
            <li>Ajouter une localisation à une Victime</li>
        </ul>
        <h1> Requete: <b>/addVictLocation.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token_vict" : "hhu8ugLdi78DyoDkleh873T8"
 "latitude" : "44.435342"<br> "longitude" : "23.34873"<br> "vitesse" : "24" //Pas obligatoire
 "altitude" : "643" //Pas obligatoire<br> "accuracy" : "292" //Pas obligatoire
               </font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Position enregistree !"
          }</pre>
        En cas de mauvais token:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":404,
                "msg":"Il manque des parametres !"
          }</pre>
        <hr>
        <h3 id="suppression"> Suppression</h3>
        <ul>
            <li>Supprimer un compte utilisateur</li>
        </ul>
        <h1> Requete: <b>/deleteUser.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"
 "user_id" : "2"</font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Compte supprime !"
          }</pre>
        En cas de permissions manquante:
      <pre class="prettyprint">
          {
                "status":500,
                "msg":"Vous n'avez pas les droits pour effectuer cette action !"
          }</pre>
        En cas de mauvais token:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token !"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":404,
                "msg":"Il manque des parametres !"
          }</pre>
        <ul>
            <li>Supprimer un compte victime</li>
        </ul>
        <h1> Requete: <b>/deleteVict.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> "token" : "hi8Viiyf43fgr765Rhfb"
 "token_vict" : "hhu8ugLdi78DyoDkleh873T8"</font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "msg":"Fichier classe !"
          }</pre>
        En cas de mauvais token victime:
      <pre class="prettyprint">
          {
                "status":203,
                "msg":"Mauvais token victime !"
          }</pre>
        En cas de mauvais token utilisateur:
      <pre class="prettyprint">
          {
                "status":202,
                "msg":"Mauvais token utilisateur!"
          }</pre>
        En cas de champ manquant:
      <pre class="prettyprint">
          {
                "status":404,
                "msg":"Il manque des parametres !"
          }</pre>
        <hr>
        <h3 id="stat"> Statistique</h3>
        <ul>
            <li>Savoir les utilisateurs en ligne</li>
        </ul>
        <h1> Requete: <b>/countOnline.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> AUCUN</font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "nbr":"12"      //Nombre d'utilisateur en ligne
          }</pre>
        <ul>
            <li>Savoir le nombre de victime en attente de localisation</li>
        </ul>
        <h1> Requete: <b>/countNotLocalised.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> AUCUN</font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "nbr":"12"      //Nombre de victime en attente de localisation
          }</pre>
        <ul>
            <li>Savoir le nombre de victime localisé</li>
        </ul>
        <h1> Requete: <b>/countLocalised.php</b> POST</h1><br>
        <pre class="requete"> Parametre:<font color="red"><br><br> AUCUN</font></pre>
        En cas de réussite:
      <pre class="prettyprint">
          {
                "status":42,
                "nbr":"12"      //Nombre de victime localisé
          }</pre>
    </div>
  </div>
</section>
<footer>
  <div class="">
    <p> &copy; Copyright Gendarmerie National. All Rights Reserved.</p>
  </div>
</footer>
</div>
<script src="js/jquery.min.js"></script> 
<script type="text/javascript" src="js/prettify/prettify.js"></script> 
<script src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js?lang=css&skin=sunburst"></script>
<script src="js/layout.js"></script>
</body>
</html>
