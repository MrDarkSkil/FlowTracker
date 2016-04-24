<?php

include $_SERVER['DOCUMENT_ROOT'] . '/class/Session.php';

if (!isset($_GET['token']))
{
    header("location: /error/client.php");
}

function    time_past($start)
{
    $time = time();

    $time = $time - $start;
    return ($time);
}
?>

<!DOCTYPE HTML>
<!--
    Miniport by HTML5 UP
    html5up.net | @n33co
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
  -->
<html>
<head>
    <title>FlowTracker</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>

<div class="wrapper style1 first">
    <article class="container" id="top">
        <div class="row">
            <div class="8u 12u(mobile)">
                <header>
                    <h1 id="zone">En cours de géolocalisation</h1>
                </header>
                <p>Ce message vous indique que votre réseau est suffisamment puissant pour disposer des services supplementaire de secours listé çi dessous.</p>
            </div>
        </div>
    </article>
</div>

<script>
    var xhr = new XMLHttpRequest();

    function maPosition(position)
    {
        xhr.open('POST', '/API/addVictLocation.php', true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.send('latitude=' + position.coords.latitude + '&longitude=' + position.coords.longitude + '&altitude=' + position.coords.altitude +
            '&accuracy=' + position.coords.accuracy + '&vitesse=' + position.coords.speed + '&token_vict=' + "<?php echo $_GET['token'] ?>");
        xhr.addEventListener('readystatechange', function() {
            if (xhr.readyState === 4) {
                var parse = JSON.parse(xhr.responseText);
                if (parse['status'] != 42)
                    window.location = "/error/client.php";
                document.getElementById("zone").innerHTML = "Vous avez été géolocalisé";
            }
        });
    }

    if(navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(maPosition);
    }
</script>
<?php $start_time = time() ?>
<div class="wrapper style1 first">
    <article class="container" id="top">
        <div class="row">
            <div class="8u 12u(mobile)">
                <header>
                    <h1 id="zone">En cours de géolocalisation</h1>
                </header>
                <p>Ce message vous indique que votre réseau est suffisamment puissant pour disposer des services supplementaire de secours listé çi dessous.</p>
            </div>
        </div>
    </article>
</div>

<!-- Work -->
<div class="wrapper style2">
    <article id="work">
        <div class="container">
            <div class="row">
                <div class="4u 12u(mobile)">
                    <section class="box style1">
                        <span class="icon featured fa-comments-o"></span>
                        <h3>Discution instantané</h3>
	                   <p>Discussion en direct avec les services de secours.</p>
                    </section>
                </div>
                <div class="4u 12u(mobile)">
                    <section class="box style1">
                        <span class="icon featured fa-camera-retro"></span>
                        <h3>Photos</h3>
                        <p>Accident, blessure, zone inaccessible... Envoyer vos photos afin de nous donner plus d'information sur les évènements ! </p>
                    </section>
                </div>
                <div class="4u 12u(mobile)">
                    <section class="box style1">
                        <span class="icon featured fa-camera-retro"></span>
                        <h3>Live vidéos</h3>
                        <p>Besoin d'aide au premier soin, d'aide à vous sortir du pétrin, la vidéo est là pour vous !</p>
                    </section>
                </div>
            </div>
        </div>
        <footer>
        </footer>
    </article>
</div>

<?php

if (time_past($start_time) < 3)
{
    echo '<iframe width="100%" height="683" frameborder="no" scrolling="no" src="/chat/?logout=true"></iframe>';
}
else
{
    echo "Le chat n'a pas pu se charger ( connexion trop lente )";
}

if (time_past($start_time) < 5)
{
    echo '<script src="/assets/js/dropzone.js"></script>
          <form action="/file-upload"
            class="dropzone"
            id="my-awesome-dropzone"></form>
          ';
}
else
{
    //message d'erreur connection
}

if (time_past($start_time) < 6)
{?>
    <!--[if lte IE 8]><script src="../assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="../assets/css/main.css" />
    <!--[if lte IE 8]><link rel="stylesheet" href="../assets/css/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="../assets/css/ie9.css" /><![endif]-->
<?php
}
else
{
    //message d'erreur connection
}

if (time_past($start_time) < 6)
{?>
    <!-- Scripts -->
    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/jquery.scrolly.min.js"></script>
    <script src="../assets/js/skel.min.js"></script>
    <script src="../assets/js/skel-viewport.min.js"></script>
    <script src="../assets/js/util.js"></script>
    <!--[if lte IE 8]><script src="../assets/js/ie/respond.min.js"></script><![endif]-->
    <script src="../assets/js/main.js"></script>
<?php
}
else
{
    //message d'erreur connection
}
?>

</body>
</html>
