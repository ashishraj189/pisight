<!DOCTYPE html>
<html>    
    <head>        
        <!-- Title -->
        <title>Modern | Extra - Contact</title>

        <meta content="width=device-width, initial-scale=1" name="viewport"/>
        <meta charset="UTF-8">
        <meta name="description" content="Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />

        <!-- Styles -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link href="<?php echo base_url(); ?>assets/plugins/pace-master/themes/blue/pace-theme-flash.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/plugins/uniform/css/uniform.default.min.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/font-awesome.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/line-icons/simple-line-icons.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/offcanvasmenueffects/css/menu_cornerbox.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/waves/waves.min.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/switchery/switchery.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/css/style.css" rel="stylesheet" type="text/css"/>	
        <link href="<?php echo base_url(); ?>assets/plugins/slidepushmenus/css/component.css" rel="stylesheet" type="text/css"/>

        <!-- Theme Styles -->
        <link href="<?php echo base_url(); ?>assets/css/modern.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/css/themes/green.css" class="theme-color" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet" type="text/css"/>

        <script src="<?php echo base_url(); ?>assets/plugins/3d-bold-navigation/js/modernizr.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/offcanvasmenueffects/js/snap.svg-min.js"></script>

        <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery-2.1.4.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <style>
            .sh{
                width: 100%; 
                background-color: #fff;
                height: 50px; 
                border-radius: 5px;
                border:1px solid #ccc;
                margin-top: 3px;
                padding-left: 20px;   
                box-shadow: 0px 5px 5px -5px rgba(0, 0, 0, 0.1);
            }
            .sc{
                width: 100%; 
                background-color: rgba(229, 229, 229, 0.28);
                height: 50px; 
                border-radius: 5px;
                border:1px solid #ccc;
                box-shadow: 0px 5px 5px -5px rgba(0, 0, 0, 0.1);
                padding: 20px;
                font-weight: 700;
                text-align: center;
            }
            .sh a,.sc a{
                margin-left: 40px;
            }
            .firstsh{
                margin-top: 50px;
            }

            .panel-body{
                padding:0px !important;
            }
            #accordion .panel .panel-heading{
                padding: 10px;
            }


        </style>

    </head>
    <body class="page-header-fixed">
        <div class="overlay"></div>       

        <div class="menu-wrap">
            <nav class="profile-menu">

            </nav>
            <button class="close-button" id="close-button">Close Menu</button>
        </div>

        <main class="page-content content-wrap">
            <div class="navbar">                
                <div class="navbar-inner">                    
                    <div class="topmenu-outer">
                        <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/logo.png">
                        <div class="top-menu">  
                            <ul class="nav navbar-nav navbar-right" style="margin-top:-57px; color:#fff; font-weight: 400;">
                                <?php
                                $logged_in = $this->session->userdata('logged_in');
                                if (empty($logged_in)) {
                                    ?>

                                    <li>
                                        <a href="#" class="log-out waves-effect waves-button waves-classic">
                                            <span>HOW IT WORKS</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="log-out waves-effect waves-button waves-classic">
                                            <span>FAQ</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="log-out waves-effect waves-button waves-classic">
                                            <span>MOBILE APP</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="log-out waves-effect waves-button waves-classic">
                                            <span>BLOG</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('user/signup'); ?>" class="log-out waves-effect waves-button waves-classic">
                                            <span>SIGNUP</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="<?php echo site_url('user'); ?>" class="log-out waves-effect waves-button waves-classic">
                                            <span>LOGIN</span>
                                        </a>
                                    </li>
                                <?php } else { ?>
                                    <li>
                                        <a href="#" class="log-out waves-effect waves-button waves-classic">
                                            <span>OVERVIEW</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="log-out waves-effect waves-button waves-classic">
                                            <span>TRANSACTION</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="log-out waves-effect waves-button waves-classic">
                                            <span>BUDGET</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="log-out waves-effect waves-button waves-classic">
                                            <span>TRENDS</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="log-out waves-effect waves-button waves-classic">
                                            <span>GOALS</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="log-out waves-effect waves-button waves-classic">
                                            <span>INVESTMENTS</span>
                                        </a>
                                    </li>

                                <?php } ?>
                            </ul><!-- Nav --> 
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div><!-- Navbar -->

            <div class="page-inner">    
                <?php
                $logged_in = $this->session->userdata('logged_in');
                if (!empty($logged_in)) {
                    ?>
                    <div class="page-title">
                        <h3 style="color:#fff;">.</h3>
                        <div class="page-breadcrumb">
                            <ol class="breadcrumb pull-right">                            
                                <li>
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>assets/images/refresh.png" alt=""/>
                                        <br>
                                        REFRESH
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>assets/images/split.png" alt=""/>
                                        <br>
                                        SPLIT CASH</a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>assets/images/alert.png" alt=""/>
                                        <br>
                                        ALERTS
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img src="<?php echo base_url(); ?>assets/images/upcoming.png" alt=""/>
                                        <br>
                                        UPCOMING BILLS
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo site_url('user/logout'); ?>">
                                        <img src="<?php echo base_url(); ?>assets/images/logout.png" alt=""/>
                                        <br>
                                        LOGOUT
                                    </a>
                                </li>
                            </ol>
                        </div>
                    </div>
                <?php } ?>