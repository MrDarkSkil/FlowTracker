<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FlowTracker - Admin</title>
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
    <!-- DataTables -->
    <link rel="stylesheet" href="/admin/plugins/datatables/dataTables.bootstrap.css">

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
include $_SERVER['DOCUMENT_ROOT'] . '/class/Victim.php';

$victime = new Victim($apiUrl);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <?php if ($victime->getVictInfo($_GET['victToken'], "status") != 42)
        {echo '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-ban"></i> Attention</h4>
            Token utilisateur incorrect.
        </div>';}?>
        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <h3 class="profile-username text-center"><?php echo $victime->getVictInfo($_GET['victToken'], "nom"); echo " "; echo $victime->getVictInfo($_GET['victToken'], "prenom");?></h3>

                        <label>Nom</label>
                        <?php echo $victime->getVictInfo($_GET['victToken'], "nom");?></br>

                        <label>Prenom</label>
                        <?php echo $victime->getVictInfo($_GET['victToken'], "prenom");?></br>

                        <label>Sexe</label>
                        <?php if ($victime->getVictInfo($_GET['victToken'], "genre") == "0") {echo "Homme";} else {echo "Femme";};?></br>

                        <label>Age de la Victime</label>
                        <?php echo $victime->getVictInfo($_GET['victToken'], "age");?></br>

                        <label>Nombre de Victime</label>
                        <?php echo $victime->getVictInfo($_GET['victToken'], "nombre");?></br>

                        <label>Numero de telephone</label>
                        <?php echo $victime->getVictInfo($_GET['victToken'], "telephone");?></br>

                        <label>Commentaire</label>
                        <?php echo $victime->getVictInfo($_GET['victToken'], "commentaire");?></br>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#map" data-toggle="tab">Map</a></li>
                        <li><a href="#chat" data-toggle="tab">Chat</a></li>
                        <li><a href="#settings" data-toggle="tab">Edition</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="map">
                            <?php if ($victime->getVictInfo($_GET['victToken'], "traitement")){?>
                            <iframe width=100% height="500" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://www.openstreetmap.org/export/embed.html?bbox=2.077789306640625 %2C 48.64198358792223 %2C 2.6030731201171875 %2C 49.025262501613014&amp;layer=mapnik&amp;marker=<?php echo $victime->getVictInfo($_GET['victToken'], "latitude");?>%2C <?php echo $victime->getVictInfo($_GET['victToken'], "longitude");?> style="border: 1px solid black"></iframe>
                            <?php
                            }
                            else
                            {
                                echo "<center><img src='http://applications.eumedgrid.eu/sonification-portlet/images/Warning.png'></center>";
                            }?>

                    </div>

                        <div class="tab-pane" id="chat">
                            <iframe width="100%" height="683" frameborder="no" scrolling="no" src="/chat/?logout=true"></iframe>
                        </div>
                        <div class="tab-pane" id="settings">
                            <form role="form">
                                <!-- text input -->
                                <div class="form-group" action="/class/victime.php" method="post" name="editVictime">

                                    <label>Nom</label>
                                    <input type="text" class="form-control" name="lastname" placeholder="Nom" value="<?php echo $victime->getVictInfo($_GET['victToken'], "nom");?>">

                                    <label>Prenom</label>
                                    <input type="text" class="form-control" name="firstname" placeholder="Prenom" value="<?php echo $victime->getVictInfo($_GET['victToken'], "prenom");?>">

                                    <label>Sexe</label>

                                    <div class="radio">
                                        <label><input type="radio" name="genre" id="gene_male" value="male" <?php if ($victime->getVictInfo($_GET['victToken'], "genre") == "0") {echo "checked";};?>>Homme</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="genre" id="genre_female" value="female" <?php if ($victime->getVictInfo($_GET['victToken'], "genre") == "1") {echo "checked";};?>>Femme</label>
                                    </div>
                                    <label>Age de la Victime</label>
                                    <input type="number" class="form-control" min="0" name="age" value="<?php echo $victime->getVictInfo($_GET['victToken'], "age");?>">

                                    <label>Nombre de Victime</label>
                                    <input type="number" class="form-control" min="0" name="nombre" value="<?php echo $victime->getVictInfo($_GET['victToken'], "nombre");?>">

                                    <label>Numero de telephone</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-phone"></i>
                                        </div>
                                        <input type="number" class="form-control" maxlength="20" data-inputmask='"mask": "(999) 999-9999"' data-mask value="<?php echo $victime->getVictInfo($_GET['victToken'], "telephone");?>">
                                    </div>

                                    <label>Commentaire</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..."><?php echo $victime->getVictInfo($_GET['victToken'], "commentaire");?></textarea>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Editer la Victime</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
<!-- DataTables -->
<script src="/admin/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });
</script>
</html>

