<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo $session->getSessionInfo("image");?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $session->getSessionInfo("nom");?> <?php echo $session->getSessionInfo("prenom");?></p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Victimes</li>
            <li><a href="/admin/victim/add.php"><i class="fa fa-circle-o"></i> <span>Ajouter une victime</span></a></li>
            <li><a href="/admin/victim/search.php"><i class="fa fa-circle-o"></i> <span>Rechercher une victime</span></a></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Liste des victimes</span>
                    <span class="label label-primary pull-right"><!-- Notification number--></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="/admin/victim/localised.php"><i class="fa fa-circle-o "></i> Localisée</a></li>
                    <li><a href="/admin/victim/notLocalised.php"><i class="fa fa-circle-o"></i> Non localisée</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
