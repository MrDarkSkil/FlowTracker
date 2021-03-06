<?php
    include $_SERVER['DOCUMENT_ROOT'] .  '/config/config.php';
    include $classFolder . "/Session.php";

    $session = new Session($apiUrl);  /** Init Class Session */
    $session->start(); /** Start session */
    if ($session->isConnected() == false) /** Check si on est connecté */
        header ("location: /session/login.php?msg=Session%20Timed%20Out&code=404");
?>

<body class="hold-transition skin-black sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="/index.php" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>F</b>T</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Flow</b>Tracker</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label "<!-- if notification number > 0 label-warning -->> <!-- notification number --></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have  <!-- notification number --> notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                            page and may cause design problems
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>

                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="/class/Session.php?action=logOut"><i class="fa fa-sign-out"></i></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>