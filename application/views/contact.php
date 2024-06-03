<?php $getOptionsSql = "SELECT * FROM `options`";
$optionsList = $this->db->query($getOptionsSql)->result(); ?>
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="<?= base_url()?>assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <h3 class="page__title">Contact Us</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contact__area pt-115 pb-120">
    <div class="container">
        <div class="row">
            <div class="col-xxl-7 col-xl-7 col-lg-6">
                <div class="contact__wrapper">
                    <div class="section__title-wrapper mb-40">
                        <h2 class="section__title">Get in touch</h2>
                        <p>Connect With Us Today</p>
                    </div>
                    <p class="e_error" style="color: #db3636;">* All fields are mandatory</p>
                    <p class="e_cerror" style="color: #db3636;">* Please check checkbox</p>
                    <div class="contact__form">
                        <form action="" id="contact-form">
                            <div class="row">
                                <div class="col-xxl-6 col-xl-6 col-md-6">
                                    <div class="contact__form-input">
                                        <input class="from-control" type="text" id="name" name="name" placeholder="Your Name" required="">
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-6 col-md-6">
                                    <div class="contact__form-input">
                                        <input class="from-control" type="text" id="email" name="email" placeholder="Your Email" required="">
                                    </div>
                                </div>
                                <div class="col-xxl-12">
                                    <div class="contact__form-input">
                                        <input class="from-control" type="text" id="subject" name="subject" placeholder="Subject" required="">
                                    </div>
                                </div>
                                <div class="col-xxl-12">
                                    <div class="contact__form-input">
                                        <textarea class="from-control" id="message" name="message" placeholder="Enter Your Message" required=""></textarea>
                                    </div>
                                </div>
                                <div class="col-xxl-12">
                                    <div class="contact__btn">
                                        <button type="button" class="e-btn text-capitalize" onclick="send_message()">Send your message</button>
                                    </div>
                                </div>
                                <div class="success_msg" style="color: #db3636; margin-top: 20px;"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xxl-4 offset-xxl-1 col-xl-4 offset-xl-1 col-lg-5 offset-lg-1">
                <div class="contact__info white-bg p-relative z-index-1">
                    <div class="contact__shape">
                        <img class="contact-shape-1" src="assets/img/contact/contact-shape-1.png" alt="">
                        <img class="contact-shape-2" src="assets/img/contact/contact-shape-2.png" alt="">
                    </div>
                    <div class="contact__info-inner white-bg">
                        <ul>
                            <li>
                                <div class="contact__info-item d-flex align-items-start mb-35">
                                    <div class="contact__info-icon mr-15">
                                        <svg class="map" viewBox="0 0 24 24">
                                            <path class="st0"
                                                d="M21,10c0,7-9,13-9,13s-9-6-9-13c0-5,4-9,9-9S21,5,21,10z" />
                                            <circle class="st0" cx="12" cy="10" r="3" />
                                        </svg>
                                    </div>
                                    <div class="contact__info-text">
                                        <h4>Office Address</h4>
                                        <p>Maypole Crescent 70-80 Upper St Norwich NR2 1L</p>

                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="contact__info-item d-flex align-items-start mb-35">
                                    <div class="contact__info-icon mr-15">
                                        <svg class="mail" viewBox="0 0 24 24">
                                            <path class="st0"
                                                d="M4,4h16c1.1,0,2,0.9,2,2v12c0,1.1-0.9,2-2,2H4c-1.1,0-2-0.9-2-2V6C2,4.9,2.9,4,4,4z" />
                                            <polyline class="st0" points="22,6 12,13 2,6 " />
                                        </svg>
                                    </div>
                                    <div class="contact__info-text">
                                        <h4>Email</h4>
                                        <p><a href="#"> info@movimientolatinouniversity.com</a></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="contact__info-item d-flex align-items-start mb-35">
                                    <div class="contact__info-icon mr-15">
                                        <svg class="call" viewBox="0 0 24 24">
                                            <path class="st0"
                                                d="M22,16.9v3c0,1.1-0.9,2-2,2c-0.1,0-0.1,0-0.2,0c-3.1-0.3-6-1.4-8.6-3.1c-2.4-1.5-4.5-3.6-6-6  c-1.7-2.6-2.7-5.6-3.1-8.7C2,3.1,2.8,2.1,3.9,2C4,2,4.1,2,4.1,2h3c1,0,1.9,0.7,2,1.7c0.1,1,0.4,1.9,0.7,2.8c0.3,0.7,0.1,1.6-0.4,2.1  L8.1,9.9c1.4,2.5,3.5,4.6,6,6l1.3-1.3c0.6-0.5,1.4-0.7,2.1-0.4c0.9,0.3,1.8,0.6,2.8,0.7C21.3,15,22,15.9,22,16.9z" />
                                        </svg>
                                    </div>
                                    <div class="contact__info-text">
                                        <h4>Phone</h4>
                                        <p><a href="#">123 456 7890</a></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div class="contact__social pl-30">
                            <h4>Follow Us</h4>
                            <ul>
                                <li><a href="#" class="fb"><i class="social_facebook"></i></a></li>
                                <li><a href="#" class="tw"><i class="social_twitter"></i></a></li>
                                <li><a href="#" class="pin"><i class="social_pinterest"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<style>
    .e_error {display: none;}
    .e_cerror {display: none;}
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

function send_message() {
    var name = $('#name').val();
    var email = $('#email').val();
    var subject = $('#subject').val();
    var phone = $('#phone').val();
    var message = $('#message').val();

    if(name == "" || email == "" || subject == "" || phone == "" || message == "") {
        $('.e_error').fadeIn('slow');
        setTimeout(() => {
            $('.e_error').fadeOut('slow');
        }, 5000);
    } else {
        $.ajax({
            url: '<?php echo base_url("home/contactFormSubmit")?>',
            type: 'post',
            data: {name: name, email: email, subject: subject, phone: phone, message: message},
            success: function (response) {
                //console.log(response);
                //$(formMessages).removeClass('error');
                //$(formMessages).addClass('success');
                $('.success_msg').text(response);
                $('#contact-form')[0].reset();
            },
            error: function () {
                if (data.responseText !== '') {
                    $('.success_msg').text(data.responseText);
                } else {
                    $('.success_msg').text('Oops! An error occured and your message could not be sent.');
                }
            },
            complete: function () {
                $('#contact-form')[0].reset();
                setTimeout(() => {
                    location.reload();
                }, 5000);
            },
        });
    }
}
</script>