<?php
$getSetting = $this->db->query("SELECT * from options")->result_array();
//echo "<pre>"; print_r($getSetting);
?>
<footer>
    <div class="footer__area footer-bg">
        <div class="footer__top pt-40 pb-20">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-12">
                        <div class="footer__widget mb-10 text-center">
                            <div class="footer__widget-head mb-22">
                                <div class="footer__logo">
                                    <a href="<?= base_url() ?>home">
                                        <img src="assets/img/footerlogo.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <div class="footer__widget-body">
                                <div class="footer__social">
                                    <ul>
                                        <li><a href="#"><i class="social_facebook"></i></a></li>
                                        <li><a href="#" class="tw"><i class="social_twitter"></i></a></li>
                                        <li><a href="#" class="pin"><i class="social_pinterest"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer__link my-4">
                                <ul>
                                    <li><a href="<?= base_url()?>community">Community</a></li>
                                    <li><a href="affiliates.html">Affiliates</a></li>
                                    <li><a href="careers.html">Careers</a></li>
                                    <li><a href="privacy.html">Privacy</a></li>
                                    <li><a href="instructor.html">Become a Instructor</a></li>
                                    <li><a href="<?= base_url()?>contact">Contact</a></li>
                                </ul>
                            </div>
                            <div class="footer__copyright text-center">
                                <p>© 2024 Movimiento Latino University. All Rights Reserved.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
</footer>
<script src="<?= base_url('assets/js/vendor/jquery-3.5.1.min.js') ?>"></script>
<script src="<?= base_url('assets/js/vendor/waypoints.min.js') ?>"></script>
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.meanmenu.js') ?>"></script>
<script src="<?= base_url('assets/js/swiper-bundle.min.js') ?>"></script>
<script src="<?= base_url('assets/js/owl.carousel.min.js') ?>"></script>
<script src="<?= base_url('assets/js/jquery.fancybox.min.js') ?>"></script>
<script src="<?= base_url('assets/js/isotope.pkgd.min.js') ?>"></script>
<script src="<?= base_url('assets/js/parallax.min.js') ?>"></script>
<script src="<?= base_url('assets/js/backToTop.js') ?>"></script>
<script src="<?= base_url('assets/js/purecounter.js') ?>"></script>
<script src="<?= base_url('assets/js/ajax-form.js') ?>"></script>
<script src="<?= base_url('assets/js/wow.min.js') ?>"></script>
<script src="<?= base_url('assets/js/imagesloaded.pkgd.min.js') ?>"></script>
<script src="<?= base_url('assets/js/main.js') ?>"></script>
<link href="<?= base_url('assets/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css">
<script src="<?= base_url('assets/sweetalert/sweetalert.min.js') ?>"></script>
<script src="<?= base_url('assets/sweetalert/jquery.sweet-alert.custom.js') ?>"></script>
<script>
    function deleteReview(id) {
        swal({
            title: 'Are you sure want to delete this review?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#36A1EA',
            cancelButtonColor: '#e50914',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                window.location.href = '<?= base_url('home/deleteReview/') ?>' + id
            }
        });
    }
    function subscribe() {
        var email = $('#user_email').val();
        if (email.length == 0) {
            $("#success").show().html("<p style='color: red; margin:0;'>Please enter your email address</p>").fadeIn(2000);
            setTimeout(function () {
                $("#success").hide();
            }, 2000);
        } else {
            $.ajax({
                url: "<?php echo site_url('Home/user_subscribe'); ?>",
                dataType: "JSON",
                method: "POST",
                data: { user_email: email },
                success: function (data) {
                    console.log(data);
                    if (data == 1) {
                        $("#success").show().html("<p style='color: red; margin:0;'>This email is already exists.</p>").fadeIn(2000);
                        setTimeout(function () {
                            location.reload();
                            $("#success").hide();
                        }, 4000);
                    } else if (data == 2) {
                        $("#success").show().html("<p style='color: green; margin:0;'>Your subscription is successful.</p>").fadeIn(2000);
                        setTimeout(function () {
                            $("#success").hide();
                        }, 4000);
                        setTimeout(function () {
                            location.reload();
                        }, 5500);
                    } else {
                        $("#error").show().html("<p style='color: green; margin:0;'>Something went wrong. Please try again.</p>").fadeIn(2000);
                        setTimeout(function () {
                            $("#error").hide();
                        }, 4000);
                    }
                }
            })
        }
    }
</script>
</body>

</html>