        <div class="section exvent-hero-section d-lg-flex d-block align-items-center inner-page-hero" style="background-image: url(<?=base_url('assets/images/')?>bg/about_page_bg.jpg);">
            <img class="shape-1 img-fluid" src="<?=base_url('assets/images/')?>shape/hero_shape1.png" alt="">
            <img class="shape-2 img-fluid" src="<?=base_url('assets/images/')?>shape/hero_shape2.png" alt="">

            <div class="container">
                <div class="row exvent-hero-row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <div class="page-title">
                            <h2 class="section-title"><?=$page?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="contact-form-section section-padding-02">
            <div class="container">
               
                <!-- Contact Form Start -->
                <div class="contact-form-wrap">
                    <form method="POST" class="contact-form" id="submitform">
                        <div class="row">
                            <div class="col-12 text-center">
                                <div class="contact-info mb-4">
									<?php if(!empty($fail_msg)){ ?>
										<div class="alert alert-danger" style="padding: 1.25rem 1.25rem;color: #ffffff;background-color: #cc2736;">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<strong><?=$fail_msg; ?></strong>
										</div>
									<?php } ?>
									
									<?php if(!empty($suc_msg)){ ?>
										<div class="alert alert-success" style="padding: 1.25rem 1.25rem;color: #ffffff;background-color: #1e70b2;">
											<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
											<strong><?=$suc_msg; ?></strong>
										</div>
									<?php } ?>
                                </div>
								<div class="col-12">
									<a href="<?=base_url('login')?>" class="forgot-pass">Back to Login</a>
								</div>
                            </div>
                        </div>
                        <div class="row g-4 justify-content-center">
                        </div>
                    </form>
                </div>
                <!-- Contact Form End -->
            </div>
        </div>