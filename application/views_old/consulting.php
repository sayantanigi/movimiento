<style>
#consulform-messages {text-align: center; margin-top: 10px;}
</style>
<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title"><?php echo $title; ?></h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url() ?>">Home</a>
                </li>
                <li><?php echo $title; ?></li>
            </ul>
        </div>
    </div>

    <div class="cs-consultant style1 pt-100 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 order-last padding-0 md-pl-15 md-pr-15 md-mb-30">
                    <div class="img-part">
                    <?php if(!empty($consultData[0]['image'])) { ?>
                        <img class="" src="<?= base_url() ?>uploads/cms/<?php echo $consultData[0]['image'];?>" alt="Consulting Image">
                        <?php } ?>
                    </div>
                </div>
                <div class="col-lg-6 pr-70 md-pr-15">
                    <div class="sec-title">
                        <div class="sub-title orange"><?php echo $consultData[0]['title']?></div>
                        <h2 class="title mb-17"><?php echo $consultData[0]['title']?></h2>
                        <div class="bold-text mb-22">
                            <?php echo $consultData[0]['description'];?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cs-consultant-form pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <img src="<?= base_url() ?>uploads/cms/<?php echo $consultData[0]['image1'];?>">
                </div>
                <div class="col-lg-6 pl-60 md-pl-15">
                    <div class="contact-comment-box">
                        <div class="inner-part">
                            <h2 class="title mb-mb-15">Consult with us</h2>
                            <p>Send us a message and we'll get your questions answered as soon as possible.</p>
                        </div>
                        
                        <form id="consulting-form" method="post" action="">
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                        <input class="from-control" type="text" id="name" name="name" placeholder="Name" required="">
                                    </div>
                                    <div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                        <input class="from-control" type="text" id="email" name="email" placeholder="Email" required="">
                                    </div>
                                    <div class="col-lg-12 mb-35 col-md-12 col-sm-12">
                                        <input class="from-control" type="text" id="phone" name="phone" placeholder="Phone" required="">
                                    </div>
                                    <div class="col-lg-12 mb-50">
                                        <textarea class="from-control" id="message" name="message" placeholder=" Message" required=""></textarea>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <input class="btn-send" type="submit" value="Submit Now">
                                </div>
                            </fieldset>
                            <div id="consulform-messages"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>