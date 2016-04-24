<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FlowTracker - TEST</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="/admin/plugins/iCheck/flat/blue.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="/admin/plugins/morris/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="/admin/plugins/datepicker/datepicker3.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php
include $_SERVER['DOCUMENT_ROOT'] .  '/config/config.php';
include $adminFolder . '/header.php';
include $adminFolder . '/sidebar.php';
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Ajout d'une Victime
            <small>Control panel</small>
        </h1>
    </section>
    <?php
    if (isset($_GET['msg']) && isset($_GET['code']))
    {
        if ($_GET['code'] == "202" || $_GET['code'] == "404")
            echo '<br><div class="alert alert-danger"><strong>'.$_GET['msg'].'</strong></div>';
        else if ($_GET['code'] == "42")
            echo '<br><div class="alert alert-success"><strong>'.$_GET['msg'].'</strong></div>';
        else
            echo '<br><div class="alert alert-success"><strong>'.$_GET['msg'].'</strong></div>';
    }
    ?>
    <br>
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">General Elements</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <form role="form" action="/class/Victim.php" method="post">
                <!-- text input -->
                <div class="form-group" action="/class/victime.php" method="post" name="addVictime">

                    <label>Nom</label>
                    <input type="text" class="form-control" name="lastname" placeholder="Nom" required>

                    <label>Prenom</label>
                    <input type="text" class="form-control" name="firstname" placeholder="Prenom" required>

                    <label>Sexe</label>
                    <div class="radio">
                    <label><input type="radio" name="genre" id="gene_male" value="male">Homme</label>
                    </div>
                    <div class="radio">
                    <label><input type="radio" name="genre" id="genre_female" value="female">Femme</label>
                    </div>
                    <label>Age de la Victime</label>
                    <input type="number" class="form-control" min="0" name="age" required>

                    <label>Nombre de Victime</label>
                    <input type="number" class="form-control" min="0" name="nombre" required>

                    <label>Numero de telephone</label>
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <input name="phone" type="number" class="form-control" maxlength="20" data-inputmask='"mask": "(999) 999-9999"' data-mask required >
                    </div>

                    <label>Commentaire</label>
                    <textarea name="commentaire" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                </div>
                <div class="box-footer">
                    <button type="submit" name="action" value="addVict" class="btn btn-primary">Ajouter la Victime</button>
                </div>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
</div>

<?php include $adminFolder . '/footer.php'; ?>

<div class="control-sidebar-bg"></div>
<!-- ./wrapper -->

<!-- jQuery 2.2.0 -->
<script src="/admin/plugins/jQuery/jQuery-2.2.0.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="/admin/plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="/admin/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="/admin/plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="/admin/plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="/admin/plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="/admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="/admin/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/admin/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="/admin/dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/admin/dist/js/demo.js"></script>
</html>

