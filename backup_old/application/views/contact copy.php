<?php $getOptionsSql = "SELECT * FROM `options`";
$optionsList = $this->db->query($getOptionsSql)->result(); ?>
<style>
#form-messages {text-align: center; margin-top: 10px;}
</style>
<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title">Contact Us</h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url() ?>">Home</a>
                </li>
                <li>Contact Us</li>
            </ul>
        </div>
    </div>
    <!-- Breadcrumbs End -->
    <div class="contact-page-section pt-100 pb-100 md-pt-70 md-pb-70">
        <div class="container">
            <div class="row rs-contact-box mb-90 md-mb-50">
                <div class="col-lg-4 col-md-12 col-sm-12 lg-pl-0 sm-mb-30 md-mb-30">
                    <div class="address-item">
                        <div class="icon-part">
                            <img src="<?= base_url() ?>user_assets/images/contact/icon/1.png" alt="">
                        </div>
                        <div class="address-text">
                            <span class="label">Address</span>
                            <span class="des"><?php echo $optionsList[6]->option_value?></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 lg-pl-0 sm-mb-30 md-mb-30">
                    <div class="address-item">
                        <div class="icon-part">
                            <img src="<?= base_url() ?>user_assets/images/contact/icon/2.png" alt="">
                        </div>
                        <div class="address-text">
                            <span class="label">Email Address</span>
                            <span class="des"><a href="mailto:<?php echo $optionsList[8]->option_value?>"><?php echo $optionsList[8]->option_value?></a></span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 lg-pl-0 sm-mb-30">
                    <div class="address-item">
                        <div class="icon-part">
                            <img src="<?= base_url() ?>user_assets/images/contact/icon/3.png" alt="">
                        </div>
                        <div class="address-text">
                            <span class="label">Phone Number</span>
                            <span class="des"><a href="tel:<?php echo $optionsList[7]->option_value?>"><?php echo $optionsList[7]->option_value?></a></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6 md-mb-30">
                    <!-- Map Section Start -->
                    <div class="contact-map3">
                    <?php if (!empty($optionsList[6]->option_value)) { 
                        $address = $optionsList[6]->option_value; ?>
                        <iframe frameborder="0" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q='<?php echo str_replace(",", "", str_replace(" ", "+", $address)) ?>'&z=14&output=embed"></iframe>
                    <?php } ?>
                    </div>
                </div>
                <div class="col-lg-6 pl-60 md-pl-15">
                    <div class="contact-comment-box">
                        <div class="inner-part">
                            <h2 class="title mb-mb-15">Get In Touch</h2>
                            <p>Have some suggestions or just want to say hi? Our support team are ready to help you 24/7.</p>
                        </div>
                        
                        <form id="contact-form" method="post" action="">
                            <fieldset>
                                <div class="row">
                                    <div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                        <input class="from-control" type="text" id="name" name="name" placeholder="Name" required="">
                                    </div>
                                    <div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                        <input class="from-control" type="text" id="email" name="email" placeholder="Email" required="">
                                    </div>
                                    <div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                        <input class="from-control" type="text" id="phone" name="phone" placeholder="Phone" required="" maxlength="10">
                                    </div>
                                    <div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                        <input class="from-control" type="text" id="address" name="address" placeholder="Address" required="">
                                    </div>
                                    <div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                        <input class="from-control" type="text" id="b_name" name="b_name" placeholder="Business name" required="">
                                    </div>
                                    <div class="col-lg-6 mb-35 col-md-6 col-sm-6">
                                        <input class="from-control" type="text" id="subject" name="subject" placeholder="Subject" required="">
                                    </div>

                                    <div class="col-lg-12 mb-50">
                                        <textarea class="from-control" id="message" name="message" placeholder=" Message" required=""></textarea>
                                    </div>
                                    <div class="col-lg-12 mb-35 col-md-6 col-sm-6">
                                    <input type="checkbox" id="upload_option" name="terms_condition" required value="1">
                                    <label for="upload_option">Check to accept <a target="_blank" href="<?= base_url('term') ?>">Term & Conditions</a></label>
                                    <div class="termsCheckSubmit">Please accept Terms & Conditions by checking the checkbox.</div>
                                    </div>
                                </div>
                                <div class="form-group mb-0">
                                    <input class="btn-send" type="submit" value="Submit Now">
                                </div>
                            </fieldset>
                            <div id="form-messages"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .termsCheckSubmit {display: none;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
$(document).ready(function(){
    checkBox = document.getElementById('upload_option').addEventListener('click', event => {
        if(event.target.checked) {
            return true;
        } else {
            setTimeout(function(){
                $('.termsCheckSubmit').toggle()
            }, 5000);
            return false;
        }
    });
})
</script>