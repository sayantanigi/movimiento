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
    <title>Movimiento Latino University</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>assets/img/favicon.png">
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
</head>
<body>
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="loading-content">
                    <img class="loading-logo-text" src="<?= base_url() ?>uploads/logo/<?= $optionsList[0]->option_value?>" alt="">
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
        <div id="header-sticky" class="header__area header__transparent header__padding">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-2 col-sm-4 col-6">
                        <div class="header__left d-flex">
                            <div class="logo">
                                <a href="<?= base_url() ?>home">
                                    <img src="<?= base_url() ?>uploads/logo/<?= $optionsList[0]->option_value?>" alt="logo">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-10 col-sm-8 col-6">
                        <div class="header__right d-flex justify-content-end align-items-center">
                            <div class="header__search p-relative ml-50 d-none d-md-block">
                                <form action="<?= base_url('Home/searchData')?>" method="post">
                                    <input type="text" name="search_data" placeholder="Search..." value="">
                                    <button type="submit"><i class="fad fa-search"></i></button>
                                </form>
                            </div>
                            <div class="main-menu ms-lg-3">
                                <nav id="mobile-menu">
                                    <?php
                                    if(!empty($this->session->userdata('user_id'))) {
                                        if($this->session->userdata('userType') == '1') { ?>
                                        <ul>
                                            <li><a href="<?= base_url()?>student-dashboard" class="e-btn">Dashboard</a></li>
                                        </ul>
                                        <?php } else { ?>
                                        <ul>
                                            <li><a href="<?= base_url()?>consultant-dashboard" class="e-btn">Dashboard</a></li>
                                        </ul>
                                    <?php } } else { ?>
                                    <ul>
                                        <li><a href="<?= base_url()?>register" class="e-btn">Sign Up</a></li>
                                        <li><a href="<?= base_url()?>login" class="e-btn">Log In</a></li>
                                    </ul>
                                    <?php } ?>
                                </nav>
                            </div>
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
                    <a href="<?= base_url() ?>home">
                        <img src="<?= base_url() ?>assets/img/logo.png" alt="logo">
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
    <div class="body-overlay"></div>