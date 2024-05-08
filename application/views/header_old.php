<?php
//echo "<pre>"; print_r($this->session->userdata());
$user_id = $this->session->userdata('user_id');
$isLoggedIn = $this->session->userdata('isLoggedIn');
$getOptionsSql = "SELECT * FROM `options`";
$optionsList = $this->db->query($getOptionsSql)->result();
?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Makutano </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.png">
    <!-- CSS here -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/preloader.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/meanmenu.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/animate.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/backToTop.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/fontAwesome5Pro.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/elegantFont.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/default.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/responsive.css">
</head>

<body>
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="loading-content-2 text-center">
                    <img class="loading-logo-text-2" src="<?= base_url() ?>assets/img/loader.svg" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <header>
        <div id="header-sticky" class="header__area header__transparent header__padding-2">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-2 col-sm-4 col-6">
                        <div class="header__left d-flex">
                            <div class="logo">
                                <a href="<?= base_url()?>">
                                    <img src="<?= base_url() ?>assets/img/logo/logo.svg" alt="logo">
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-10 col-sm-8 col-6">
                        <div class="header__right d-flex justify-content-end align-items-center">
                            <div class="main-menu main-menu-2">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li class="has-dropdown"><a href="#">Next Level Masterclass</a>
                                            <ul class="submenu">
                                                <li><a href="<?= base_url()?>course-list">Next Level Masterclass</a></li>
                                                <li><a href="https://levelupmakutano.com/">Level Up</a></li>
                                                <li><a href="#">Mak-WorkBook</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="<?= base_url()?>store">Store</a></li>
                                        <li><a href="<?= base_url()?>event">Events Ticket</a></li>
                                        <li class="has-dropdown">
                                            <a href="#">#Makutano9</a>
                                            <ul class="submenu">
                                                <li><a href="#">Présentation #Makutano9</a></li>
                                                <li><a href="#">Programme Séjour</a></li>
                                                <li><a href="#">Programme Forum</a></li>
                                                <li><a href="<?= base_url()?>portfolio9">Portfolio #Makutano9</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">
                                            <a href="#">Forum</a>
                                            <ul class="submenu">
                                                <li><a href="#">Makutano 8</a>
                                                    <ul class="submenu">
                                                        <li><a href="#">Présentation #Makutano8</a></li>
                                                        <li><a href="#">Program</a></li>
                                                        <li><a href="#">Intervenants</a></li>
                                                        <li><a href="#">Partenaires</a></li>
                                                        <li><a href="<?= base_url()?>portfolio8">Portfolio #Makutano8</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Makutano 7</a>
                                                    <ul class="submenu">
                                                        <li><a href="#">Livre blanc #Makutano7</a></li>
                                                        <li><a href="#">Program</a></li>
                                                        <li><a href="#">Thématiques</a></li>
                                                        <li><a href="#">Communiqué de presse bilan</a></li>
                                                        <li><a href="#">Partenaires</a></li>
                                                        <li><a href="<?= base_url()?>portfolio7">Portfolio #Makutano7</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">
                                            <a href="#">Institute</a>
                                            <ul class="submenu">
                                                <li><a href="#">Institute</a></li>
                                                <li><a href="#">Publications</a>
                                                    <ul class="submenu">
                                                        <li><a href="#">Conference proceedings</a></li>
                                                        <li><a href="#">Makutano Analytics</a></li>
                                                        <li><a href="#">Work documents</a></li>
                                                        <li><a href="#">RABA/ARBI</a></li>
                                                    </ul>
                                                </li>
                                                <li><a href="#">Conferences</a></li>
                                                <li><a href="#">Statutes</a></li>
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">
                                            <a href="#">Network</a>
                                            <ul class="submenu">
                                                <li><a href="#">Network news</a></li>
                                                <li><a href="#">Newsletter</a></li>
                                                <li><a href="#">Women in Business</a></li>
                                                <li><a href="#">Levelup Makutano</a></li>
                                            </ul>
                                        </li>
                                        <!-- <li><a href="#">Foundation</a></li>
                                            <li><a href="#">Youth</a></li>
                                            <li><a href="#">Contact</a></li> -->
                                    </ul>
                                </nav>
                            </div>
                            <?php 
                            if(!empty($this->session->userdata('user_id'))) { 
                            if($this->session->userdata('userType') == '1') { ?>
                            <div class="header__btn header__btn-2 ml-30">
                                <a href="<?= base_url()?>student-dashboard" class="e-btn">Dashboard</a>
                            </div>
                            <?php } else { ?>
                            <div class="header__btn header__btn-2 ml-30">
                                <a href="<?= base_url()?>consultant-dashboard" class="e-btn">Dashboard</a>
                            </div>
                            <?php } } else { ?>
                            <div class="header__btn header__btn-2 ml-30">
                                <a href="<?= base_url()?>register" class="e-btn">Sign Up</a>
                            </div>
                            <?php } ?>
                            <div class="sidebar__menu d-xl-none">
                                <div class="sidebar-toggle-btn ml-30" id="sidebar-toggle">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="body-overlay"></div>
    <!-- sidebar area start -->
    <div class="sidebar__area">
        <div class="sidebar__wrapper">
            <div class="sidebar__close">
                <button class="sidebar__close-btn" id="sidebar__close-btn">
                    <span><i class="fal fa-times"></i></span>
                    <span>close</span>
                </button>
            </div>
            <div class="sidebar__content">
                <div class="logo mb-40">
                    <a href="index.html">
                        <img src="<?= base_url() ?>assets/img/logo/logo-dark.svg" alt="logo">
                    </a>
                </div>
                <div class="mobile-menu fix"></div>
                <div class="sidebar__search p-relative mt-40 ">
                    <form action="#">
                        <input type="text" placeholder="Search...">
                        <button type="submit"><i class="fad fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- sidebar area end -->
    <div class="body-overlay"></div>
    <!-- sidebar area end -->