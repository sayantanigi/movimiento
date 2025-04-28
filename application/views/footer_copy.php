<?php $getOptionsSql = "SELECT * FROM `options`";
$optionsList = $this->db->query($getOptionsSql)->result(); ?>
<!-- Footer Start -->
<footer id="rs-footer" class="rs-footer home9-style main-home home14-style home15">
    <div class="footer-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 footer-widget md-mb-50 position-relative">
                    <div class="footer-logo mb-30">
                        <a href="<?= base_url() ?>"><img src="<?= base_url() ?>uploads/logo/<?php echo $optionsList[0]->option_value ?>" alt=""></a>
                    </div>
                    <div class="textwidget pr-60 md-pr-15">
                        <p class="m-0">&copy; 2023 Makutano All Rights Reserved. </p>
                    </div>
                </div>

                <div class="col-lg-3 col-md-12 col-sm-12 pl-50 md-pl-15 footer-widget md-mb-50">
                    <h3 class="widget-title">Quick Links</h3>
                    <ul class="site-map">
                        <li><a href="<?= base_url() ?>">Home</a></li>
                        <li><a href="<?php echo base_url('about') ?>">About Us</a></li>
                        <li><a href="<?php echo base_url('course-list') ?>">Courses</a></li>
                        <li><a href="<?php echo base_url('consulting') ?>">Consulting</a></li>
                        <li><a href="<?php echo base_url('contact') ?>">Contact Us</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 footer-widget md-mb-50">
                    <h3 class="widget-title">Address</h3>
                    <ul class="address-widget">
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24.509" height="20" viewBox="0 0 24.509 20">
                                <g id="Icon_feather-mail" data-name="Icon feather-mail" transform="translate(1 1)">
                                    <path id="Path_1" data-name="Path 1" d="M5.238,5H23.271a3.241,3.241,0,0,1,3.238,3.238V21.762A3.241,3.241,0,0,1,23.271,25H5.238A3.241,3.241,0,0,1,2,21.762V8.238A3.241,3.241,0,0,1,5.238,5ZM23.271,23.033a1.272,1.272,0,0,0,1.271-1.271V8.238a1.272,1.272,0,0,0-1.271-1.271H5.238A1.272,1.272,0,0,0,3.967,8.238V21.762a1.272,1.272,0,0,0,1.271,1.271Z" transform="translate(-3 -6)" fill="#186aff" />
                                    <path id="Path_2" data-name="Path 2" d="M14.254,18.022a.971.971,0,0,1-.564-.181L2.419,9.819a1.011,1.011,0,0,1-.242-1.393.973.973,0,0,1,1.37-.246L14.254,15.8,24.961,8.181a.973.973,0,0,1,1.37.246,1.011,1.011,0,0,1-.242,1.393L14.818,17.841A.971.971,0,0,1,14.254,18.022Z" transform="translate(-3 -6.708)" fill="#186aff" />
                                </g>
                            </svg>
                            <div class="desc">
                                <a href="mailto:<?php echo $optionsList[8]->option_value ?>"><?php echo $optionsList[8]->option_value ?></a>
                            </div>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="19.964" height="20" viewBox="0 0 19.964 20">
                                <path id="Icon_feather-phone-call" data-name="Icon feather-phone-call" d="M7.6,1.646a2.663,2.663,0,0,1,2.624,2.28v.007a11.06,11.06,0,0,0,.6,2.417,2.658,2.658,0,0,1-.6,2.795l0,0L9.5,9.876a13.969,13.969,0,0,0,4.4,4.4l.728-.728,0,0a2.65,2.65,0,0,1,2.8-.6,11.056,11.056,0,0,0,2.415.6h.007a2.65,2.65,0,0,1,2.28,2.68v2.759a2.651,2.651,0,0,1-2.651,2.658c-.079,0-.16,0-.239-.011h-.014a19.16,19.16,0,0,1-8.312-2.956A18.923,18.923,0,0,1,5.136,12.9,19.159,19.159,0,0,1,2.18,4.548V4.535A2.651,2.651,0,0,1,4.816,1.646Zm1.03,2.5A1.045,1.045,0,0,0,7.6,3.256H4.817A1.04,1.04,0,0,0,3.782,4.385a17.54,17.54,0,0,0,2.707,7.641l0,.006a17.3,17.3,0,0,0,5.289,5.289l.006,0a17.541,17.541,0,0,0,7.6,2.707,1.04,1.04,0,0,0,1.128-1.041V16.219q0-.01,0-.02a1.04,1.04,0,0,0-.892-1.056,12.673,12.673,0,0,1-2.765-.689,1.04,1.04,0,0,0-1.1.232L14.6,15.857a.805.805,0,0,1-.967.131A15.577,15.577,0,0,1,7.79,10.149a.805.805,0,0,1,.131-.967L9.091,8.011a1.043,1.043,0,0,0,.232-1.1A12.677,12.677,0,0,1,8.633,4.148Z" transform="translate(-2.168 -1.646)" fill="#186aff" />
                            </svg>
                            <div class="desc">
                                <a href="tel:<?php echo $optionsList[7]->option_value ?>"><?php echo $optionsList[7]->option_value ?></a>
                            </div>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" width="15.714" height="20" viewBox="0 0 15.714 20">
                                <g id="location-information-svgrepo-com" transform="translate(-160 -64)">
                                    <path id="Path_47" data-name="Path 47" d="M256.714,896h10a.714.714,0,1,1,0,1.429h-10a.714.714,0,1,1,0-1.429Z" transform="translate(-93.857 -813.429)" fill="#186aff" />
                                    <path id="Path_48" data-name="Path 48" d="M174.286,71.857a6.429,6.429,0,1,0-12.857,0c0,2.637,2.11,6.074,6.429,10.191C172.176,77.931,174.286,74.494,174.286,71.857ZM167.857,84Q160,76.858,160,71.857a7.857,7.857,0,0,1,15.714,0Q175.714,76.856,167.857,84Z" fill="#186aff" />
                                    <path id="Path_49" data-name="Path 49" d="M355.571,261.714a2.143,2.143,0,1,0-2.143-2.143A2.143,2.143,0,0,0,355.571,261.714Zm0,1.429a3.571,3.571,0,1,1,3.571-3.571A3.571,3.571,0,0,1,355.571,263.143Z" transform="translate(-187.714 -187.714)" fill="#186aff" />
                                </g>
                            </svg>
                            <div class="desc"><?php echo $optionsList[6]->option_value ?></div>
                        </li>
                        <li class="footer_social_Part">
                            <ul class="footer_social">
                                <li>
                                    <a href="<?php echo $optionsList[3]->option_value ?>" target="_blank">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="8.905" height="18.459" viewBox="0 0 8.905 18.459">
                                                <path id="facebook-svgrepo-com" d="M-331.513,276.951c0-.743.663-1.009,1.406-1.009a6.4,6.4,0,0,1,1.536.231l.476-2.827a11.856,11.856,0,0,0-3.418-.346,3.4,3.4,0,0,0-2.964,1.392,5,5,0,0,0-.613,2.863v1.853H-337v2.762h1.911v9.59h3.576v-9.59h2.834l.209-2.762h-3.043Z" transform="translate(337 -273)" fill="#186aff" />
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $optionsList[2]->option_value ?>" target="_blank">
                                        <span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20.154" height="16.378" viewBox="0 0 20.154 16.378">
                                                <path id="Icon_metro-twitter" data-name="Icon metro-twitter" d="M22.724,6.756a8.267,8.267,0,0,1-2.375.651A4.147,4.147,0,0,0,22.168,5.12a8.278,8.278,0,0,1-2.626,1A4.139,4.139,0,0,0,12.5,9.894a11.739,11.739,0,0,1-8.522-4.32,4.139,4.139,0,0,0,1.28,5.52,4.118,4.118,0,0,1-1.873-.517c0,.017,0,.035,0,.052A4.137,4.137,0,0,0,6.7,14.684a4.142,4.142,0,0,1-1.867.071,4.139,4.139,0,0,0,3.862,2.871A8.3,8.3,0,0,1,3.557,19.4a8.386,8.386,0,0,1-.986-.058A11.7,11.7,0,0,0,8.909,21.2,11.684,11.684,0,0,0,20.673,9.431q0-.269-.012-.535a8.4,8.4,0,0,0,2.063-2.14Z" transform="translate(-2.571 -4.817)" fill="#186aff" />
                                            </svg>
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo $optionsList[16]->option_value ?>" target="_blank">
                                        <span>
                                            <svg id="Group_63" data-name="Group 63" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="18.492" height="18.459" viewBox="0 0 18.492 18.459">
                                                <defs>
                                                    <clipPath id="clip-path">
                                                        <rect id="Rectangle_134" data-name="Rectangle 134" width="18.492" height="18.459" fill="#186aff" />
                                                    </clipPath>
                                                </defs>
                                                <rect id="Rectangle_133" data-name="Rectangle 133" width="3.837" height="12.325" transform="translate(0.306 6.134)" fill="#186aff" />
                                                <g id="Group_36" data-name="Group 36" transform="translate(0 0)">
                                                    <g id="Group_35" data-name="Group 35" clip-path="url(#clip-path)">
                                                        <path id="Path_2983" data-name="Path 2983" d="M2.222,0h0A2.221,2.221,0,1,0,4.442,2.22,2.219,2.219,0,0,0,2.22,0" transform="translate(0 0)" fill="#186aff" />
                                                        <path id="Path_2984" data-name="Path 2984" d="M9.116,8.549h.006v0Z" transform="translate(-2.576 -2.415)" fill="#186aff" />
                                                        <path id="Path_2985" data-name="Path 2985" d="M16.474,8.124a4.029,4.029,0,0,0-3.632,1.99h-.051V8.43H9.123V20.752H12.95v-6.1c0-1.606.307-3.164,2.3-3.164,1.965,0,1.991,1.84,1.991,3.269v5.995H21.07v-6.76c0-3.318-.716-5.871-4.6-5.871" transform="translate(-2.578 -2.296)" fill="#186aff" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo $optionsList[18]->option_value ?>" target="_blank">
                                        <span>
                                            <svg id="Instagram-Glyph-Color-Logo.wine" xmlns="http://www.w3.org/2000/svg" width="18.459" height="18.459" viewBox="0 0 18.459 18.459">
                                                <path id="Path_2978" data-name="Path 2978" d="M2.223-5.424A1.109,1.109,0,0,0,1.114-6.533,1.109,1.109,0,0,0,.005-5.424,1.108,1.108,0,0,0,1.114-4.318,1.108,1.108,0,0,0,2.223-5.424" transform="translate(13.042 9.728)" fill="#186aff" />
                                                <path id="Path_2979" data-name="Path 2979" d="M16.741-41.045a5.149,5.149,0,0,1-.317,1.714,2.851,2.851,0,0,1-.693,1.061,2.82,2.82,0,0,1-1.06.689,5.133,5.133,0,0,1-1.715.321c-.973.043-1.261.052-3.728.052s-2.756-.009-3.728-.052a5.116,5.116,0,0,1-1.713-.321,2.823,2.823,0,0,1-1.061-.689,2.813,2.813,0,0,1-.691-1.061,5.089,5.089,0,0,1-.317-1.714c-.047-.973-.056-1.266-.056-3.728s.009-2.758.056-3.731a5.122,5.122,0,0,1,.317-1.716,2.809,2.809,0,0,1,.691-1.059,2.855,2.855,0,0,1,1.061-.691A5.117,5.117,0,0,1,5.5-52.288c.973-.043,1.264-.054,3.728-.054s2.756.011,3.728.054a5.134,5.134,0,0,1,1.715.319,2.852,2.852,0,0,1,1.06.691,2.846,2.846,0,0,1,.693,1.059,5.183,5.183,0,0,1,.317,1.716c.045.973.056,1.264.056,3.731S16.787-42.018,16.741-41.045ZM18.4-48.58a6.708,6.708,0,0,0-.431-2.241,4.5,4.5,0,0,0-1.063-1.636,4.538,4.538,0,0,0-1.634-1.064,6.728,6.728,0,0,0-2.241-.428C12.051-54,11.736-54,9.228-54s-2.822.009-3.806.056a6.755,6.755,0,0,0-2.241.428A4.55,4.55,0,0,0,1.55-52.456,4.535,4.535,0,0,0,.484-50.82,6.825,6.825,0,0,0,.054-48.58C.011-47.6,0-47.281,0-44.773s.011,2.82.054,3.8a6.853,6.853,0,0,0,.431,2.241A4.527,4.527,0,0,0,1.55-37.095a4.549,4.549,0,0,0,1.632,1.066,6.813,6.813,0,0,0,2.241.428c.984.045,1.3.056,3.806.056s2.822-.011,3.806-.056a6.786,6.786,0,0,0,2.241-.428,4.538,4.538,0,0,0,1.634-1.066,4.49,4.49,0,0,0,1.063-1.634A6.736,6.736,0,0,0,18.4-40.97c.045-.984.056-1.3.056-3.8S18.448-47.6,18.4-48.58Z" transform="translate(0 54.004)" fill="#186aff" />
                                                <path id="Path_2980" data-name="Path 2980" d="M4.8-20a3.075,3.075,0,0,1-3.076-3.074A3.077,3.077,0,0,1,4.8-26.153a3.079,3.079,0,0,1,3.078,3.078A3.077,3.077,0,0,1,4.8-20Zm0-7.816A4.74,4.74,0,0,0,.06-23.075,4.738,4.738,0,0,0,4.8-18.337a4.74,4.74,0,0,0,4.74-4.738A4.742,4.742,0,0,0,4.8-27.817Z" transform="translate(4.431 32.306)" fill="#186aff" />
                                            </svg>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="footer-bottom">
        <div class="container">
            <div class="row y-middle">
                <div class="col-lg-12 md-mb-20 text-center">
                    <div class="copyright">
                        <p>&copy; 2023 Makutano All Rights Reserved. </p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</footer>
<!-- Footer End -->

<!-- start scrollUp  -->
<div id="scrollUp" class="orange-color">
    <i class="fa fa-angle-up"></i>
</div>
<!-- End scrollUp  -->

<!-- Search Modal Start -->
<div aria-hidden="true" class="modal fade search-modal" role="dialog" tabindex="-1">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span class="flaticon-cross"></span>
    </button>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="search-block clearfix">
                <form>
                    <div class="form-group">
                        <input class="form-control" placeholder="Search Here..." type="text">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Search Modal End -->

<input type="hidden" id="baseUrl" value="<?= base_url() ?>">
<input type="hidden" id="adminUrl" value="<?= base_url() ?>">
<style type="text/css" media="screen">
    .invalid-feedback {
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
        font-weight: 500;
    }

    .is-invalid {
        border: 1px solid #dc3545 !important;
    }

    .truncate {
        width: 190px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .truncate2 {
        width: 327px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .intl-tel-input {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .eyepanel {
        position: absolute;
        top: 12px;
        font-size: 20px;
        right: 25px;
        z-index: 1;
        cursor: pointer;
    }

    .blockUI h1 {
        font-size: 30px;
        font-weight: 600;
        color: #fff;
        margin: 0;
    }
</style>

<!-- modernizr js -->
<script src="<?= base_url('user_assets/js/modernizr-2.8.3.min.js') ?>"></script>
<!-- jquery latest version -->
<script src="<?= base_url('user_assets/js/jquery.min.js') ?>"></script>
<!-- Bootstrap v4.4.1 js -->
<script src="<?= base_url('user_assets/js/bootstrap.min.js') ?>"></script>
<!-- Menu js -->
<script src="<?= base_url('user_assets/js/rsmenu-main.js') ?>"></script>
<!-- op nav js -->
<script src="<?= base_url('user_assets/js/jquery.nav.js') ?>"></script>
<!-- owl.carousel js -->
<script src="<?= base_url('user_assets/js/owl.carousel.min.js') ?>"></script>
<!-- Slick js -->
<script src="<?= base_url('user_assets/js/slick.min.js') ?>"></script>
<!-- isotope.pkgd.min js -->
<script src="<?= base_url('user_assets/js/isotope.pkgd.min.js') ?>"></script>
<!-- imagesloaded.pkgd.min js -->
<script src="<?= base_url('user_assets/js/imagesloaded.pkgd.min.js') ?>"></script>
<!-- wow js -->
<script src="<?= base_url('user_assets/js/wow.min.js') ?>"></script>
<!-- Skill bar js -->
<script src="<?= base_url('user_assets/js/skill.bars.jquery.js') ?>"></script>
<script src="<?= base_url('user_assets/js/jquery.counterup.min.js') ?>"></script>
<!-- counter top js -->
<script src="<?= base_url('user_assets/js/waypoints.min.js') ?>"></script>
<!-- video js -->
<script src="<?= base_url('user_assets/js/jquery.mb.YTPlayer.min.js') ?>"></script>
<!-- magnific popup js -->
<script src="<?= base_url('user_assets/js/jquery.magnific-popup.min.js') ?>"></script>
<!-- tilt js -->
<script src="<?= base_url('user_assets/js/tilt.jquery.min.js') ?>"></script>
<!-- plugins js -->
<script src="<?= base_url('user_assets/js/plugins.js') ?>"></script>
<!-- contact form js -->
<script src="<?= base_url('user_assets/js/contact.form.js') ?>"></script>
<script src="<?= base_url('user_assets/js/unsubscribe.form.js') ?>"></script>
<script src="<?= base_url('user_assets/js/consulting.form.js') ?>"></script>
<!-- main js -->
<script src="<?= base_url('user_assets/js/main.js') ?>"></script>
<script src="<?= base_url('vendor/jquery-validation/jquery.validate.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="<?= base_url('assets/js/intlTelInput.min.js') ?>"></script>
<script src="<?= base_url('user_assets/js/jquery.creditCardValidator.js') ?>"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
<script>
    $('#card-number').mask('0000 0000 0000 0000');
    $('#expiry_month').mask('00');
    $('#expiry_year').mask('0000');

    function validate() {
        var valid = true;
        $(".demoInputBox").css('background-color', '');
        var message = "";
        var cardHolderNameRegex = /^[a-z ,.'-]+$/i;
        var cvvRegex = /^[0-9]{3,3}$/;
        var cardHolderName = $("#card-holder-name").val();
        var cardNumber = $("#cardNumber").val();
        var cvv = $("#cvv").val();

        if (cardHolderName == "" || cardNumber == "" || cvv == "") {
            message += "<div>All Fields are Required.</div>";
            if (cardHolderName == "") {
                $("#card-holder-name").css('background-color', '#FFFFDF');
            }
            if (cardNumber == "") {
                $("#cardNumber").css('background-color', '#FFFFDF');
            }
            if (cvv == "") {
                $("#cvv").css('background-color', '#FFFFDF');
            }
            valid = false;
        }

        if (cardHolderName != "" && !cardHolderNameRegex.test(cardHolderName)) {
            message += "<div>Card Holder Name is Invalid</div>";
            $("#card-holder-name").css('background-color', '#FFFFDF');
            valid = false;
        }

        if (cardNumber != "") {
            $('#cardNumber').validateCreditCard(function(result) {
                if (!(result.valid)) {
                    message += "<div>Card Number is Invalid</div>";
                    $("#cardNumber").css('background-color', '#FFFFDF');
                    valid = false;
                }
            });
        }

        if (cvv != "" && !cvvRegex.test(cvv)) {
            message += "<div>CVV is Invalid</div>";
            $("#cvv").css('background-color', '#FFFFDF');
            valid = false;
        }

        if (message != "") {
            $("#error-message").show();
            $("#error-message").html(message);
        }
        return valid;
    }
</script>

<script>
    var telInputLog = $("#phone"),
        errorMsg = $("#error-msg"),
        validMsg = $("#valid-msg");

    // initialise plugin
    telInputLog.intlTelInput({
        autoPlaceholder: true,
        defaultCountry: "auto",
        numberType: "MOBILE",
        onlyCountries: ['us', 'gb', 'br', 'ru', 'cn', 'es', 'it', 'ca', 'et', 'in'],
        initialCountry: "et",
        hiddenInput: "full",
        geoIpLookup: function(callback) {
            $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js"
    });

    var reset = function() {
        telInputLog.removeClass("error");
        errorMsg.addClass("hide");
        validMsg.addClass("hide");
    };

    // on blur: validate
    telInputLog.blur(function() {
        if ($.trim(telInputLog.val())) {
            if (telInputLog.intlTelInput("isValidNumber")) {
                validMsg.removeClass("hide");
            } else {
                telInputLog.addClass("error");
                errorMsg.removeClass("hide");
            }
        }
    });

    // on keyup / change flag: reset
    telInputLog.on("keyup change", reset);
</script>

<script>
    $(function() {
        $.validator.addMethod("phoneNumValidation", function(value) {
            return $("#phone").intlTelInput("isValidNumber")
        }, 'Please enter a valid number');

        // Add Method too jQuery Validator
        $.validator.addMethod("noSpace", function(value, element) {
            return value.indexOf(" ") < 0 && value != "" && value != "-";
        }, "No space is allowed");

        jQuery.validator.addMethod("noHTMLtags", function(value, element) {
            return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
        }, "Must contain only letters, numbers, or underscore.");

        $.validator.addMethod("strong_password", function(value, element) {
            let password = value;
            if (!(/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[@#$%&])(.{8,20}$)/.test(password))) {
                return false;
            }
            return true;
        }, function(value, element) {
            let password = $(element).val();
            if (!(/^(.{8,20}$)/.test(password))) {
                return 'Password must be between 8 to 20 characters long.';
            } else if (!(/^(?=.*[A-Z])/.test(password))) {
                return 'Password must contain at least one uppercase.';
            } else if (!(/^(?=.*[a-z])/.test(password))) {
                return 'Password must contain at least one lowercase.';
            } else if (!(/^(?=.*[0-9])/.test(password))) {
                return 'Password must contain at least one digit.';
            } else if (!(/^(?=.*[@#$%&])/.test(password))) {
                return "Password must contain special characters from @#$%&.";
            }
            return false;
        });

        $.validator.setDefaults({
            submitHandler: function() {
                // alert( "Form successful submitted!" );
                $("#phone_full").val($("#phone").intlTelInput("getNumber"));
                $("#phone_code").val($("#phone").intlTelInput("getSelectedCountryData").dialCode);
                $("#phone_country").val($("#phone").intlTelInput("getSelectedCountryData").name);
                $("#phone_st_country").val($("#phone").intlTelInput("getSelectedCountryData").iso2);

                return true;
            }
        });
        $('#quickFormValidation').validate({
            ignore: [],
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
                confirm_password: {
                    required: true,
                    minlength: 6,
                    equalTo: "#password"
                },
                first_name: {
                    required: true
                },
                terms_accept: {
                    required: true
                },
                phone: {
                    required: true,
                    phoneNumValidation: true
                },
            },
            messages: {
                email: {
                    required: "Please enter a email address",
                    email: "Please enter a vaild email address"
                },
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                confirm_password: {
                    required: "Please provide a confirm password",
                    minlength: "Your password must be at least 6 characters long"
                },
                first_name: {
                    required: "Please enter a first name"
                },
                terms_accept: {
                    required: "Please accept the terms & conditions"
                },
                phone: {
                    required: "Please enter a valid phone number"
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });

    function preview_image(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('output_image');
            output.src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

<script>
    $(function() {
        $('#eye').click(function() {
            if ($(this).hasClass('fa-eye-slash')) {
                $(this).removeClass('fa-eye-slash');
                $(this).addClass('fa-eye');
                $('#password').attr('type', 'text');
            } else {
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
                $('#password').attr('type', 'password');
            }
        });

        $('#eye2').click(function() {
            if ($(this).hasClass('fa-eye-slash')) {
                $(this).removeClass('fa-eye-slash');
                $(this).addClass('fa-eye');
                $('#confirm_password').attr('type', 'text');
            } else {
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
                $('#confirm_password').attr('type', 'password');
            }
        });
    });
    $(".alert").delay(7000).fadeOut(1500);
</script>



<script type="text/javascript">
    $(document).ready(function() {
        var base_color = "rgb(230,230,230)";
        var active_color = "#0089ff";
        var child = 1;
        var length = $(".mainsteps").length - 1;
        var m_id = $("#m_id").val();
        $("#prev").addClass("disabled");
        $("#submit").addClass("disabled");
        $(".mainsteps").not(".mainsteps:nth-of-type(1)").hide();
        $(".mainsteps").not(".mainsteps:nth-of-type(1)").css('transform', 'translateX(100px)');
        var svgWidth = length * 200 + 24;
        $("#svg_wrap").html(
            '<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' +
            svgWidth +
            ' 24" xml:space="preserve"></svg>'
        );

        function makeSVG(tag, attrs) {
            var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
            for (var k in attrs) el.setAttribute(k, attrs[k]);
            return el;
        }
        if (m_id > 1) {
            for (i = 0; i < length; i++) {
                var positionX = 12 + i * 200;
                var rect = makeSVG("rect", {
                    x: positionX,
                    y: 9,
                    width: 200,
                    height: 6
                });
                document.getElementById("svg_form_time").appendChild(rect);
                // <g><rect x="12" y="9" width="200" height="6"></rect></g>'
                var circle = makeSVG("circle", {
                    cx: positionX,
                    cy: 12,
                    r: 12,
                    width: positionX,
                    height: 6
                });
                document.getElementById("svg_form_time").appendChild(circle);
            }

            if (positionX) {
                positionX = positionX + 200;
            } else {
                positionX = 12;
            }

            var circle = makeSVG("circle", {
                // cx: positionX + 200,
                cx: positionX,
                cy: 12,
                r: 12,
                width: positionX,
                height: 6
            });

            document.getElementById("svg_form_time").appendChild(circle);
        }

        $('#svg_form_time rect').css('fill', base_color);
        $('#svg_form_time circle').css('fill', base_color);
        $("circle:nth-of-type(1)").css("fill", active_color);
        $(".button").click(function() {
            $("#svg_form_time rect").css("fill", active_color);
            $("#svg_form_time circle").css("fill", active_color);
            var id = $(this).attr("id");
            if (id == "next") {
                $("#prev").removeClass("disabled");
                if (child >= length) {
                    $(this).addClass("disabled");
                    $('#submit').removeClass("disabled");
                }
                if (child <= length) {
                    child++;
                }
            } else if (id == "prev") {
                $("#next").removeClass("disabled");
                $('#submit').addClass("disabled");
                if (child <= 2) {
                    $(this).addClass("disabled");
                }
                if (child > 1) {
                    child--;
                }
            }
            var circle_child = child + 1;
            $("#svg_form_time rect:nth-of-type(n + " + child + ")").css(
                "fill",
                base_color
            );
            $("#svg_form_time circle:nth-of-type(n + " + circle_child + ")").css(
                "fill",
                base_color
            );
            var currentSection = $(".mainsteps:nth-of-type(" + child + ")");
            currentSection.fadeIn();
            currentSection.css('transform', 'translateX(0)');
            currentSection.prevAll('.mainsteps').css('transform', 'translateX(-100px)');
            currentSection.nextAll('.mainsteps').css('transform', 'translateX(100px)');
            $('.mainsteps').not(currentSection).hide();
        });
    });

    $('.prevbtnClass').hide();
    $('.nextbtnClass').hide();
    $('.submitbtn').hide();
    $('#nextbtn-1').show();

    function getCompletedMaterial(enrollment_id, id, key, total) {
        $('.nextbtnClass').hide();
        $('.prevbtnClass').hide();
        $('.submitbtn').hide();
        $('.matcommon').removeClass('disabled');
        $('.matcommonPrv').removeClass('disabled');
        var prev = parseInt(key) - 1;
        var next = parseInt(key) + 1;
        if (key < total) {
            $('#prevbtn-' + next).show();
            $('#nextbtn-' + next).show();
        }
        if (next == total) {

            $('#prevbtn-' + next).show();
            $('#nextbtn-' + next).show();
            $('.material-' + next).hide();
            $('#submitbtn-' + next).show();
        }
    }

    function getQuizMaterial(enrollment_id, id, key, total) {
        var x = $('#quiz-form-' + key).serializeArray();
        var input = document.getElementsByName('questions-' + key + '[]');
        var optionArray = [];
        for (var i = 0; i < input.length; i++) {
            var qId = input[i].value;
            var optId = 'que-' + key + '-' + qId;
            var ele = document.getElementsByName('que-' + key + '-' + qId);
            const radioButtons = document.querySelectorAll('input[name=' + optId + ']');
            let selectedOptions;
            for (j = 0; j < ele.length; j++) {
                if (ele[j].checked) {
                    // alert(" Question" + qId + " Answer: "+ele[j].value);
                    optionArray.push({
                        id: qId,
                        choice: ele[j].value
                    });
                }
            }

            for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    selectedOptions = radioButton.value;
                    break;
                }
            }

            var output = selectedOptions ? selectedOptions : '';
            if (output == '') {
                optionArray.push({
                    id: qId,
                    choice: ""
                });
            }
        }

        if (typeof optionArray !== 'undefined' && optionArray.length > 0) {
            console.log(optionArray);
            if (enrollment_id != '' && id != '') {
                var baseUrl = "<?= base_url(); ?>";
                $.ajax({
                    url: baseUrl + 'users/courseQuizMaterial',
                    type: 'POST',
                    data: {
                        enrollment_id: enrollment_id,
                        id: id,
                        key: key,
                        page: 'next',
                        optionArray: optionArray
                    },
                    beforeSend: function() {
                        $.blockUI({
                            css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .5,
                                color: '#fff'
                            }
                        });
                        setTimeout($.unblockUI, 2000);
                    },
                    success: function(data) {
                        // $('#quizHTML-' + key).empty();
                        $('#quizResultHTML-' + key).show();
                        $('#quizResultHTML-' + key).html(data);
                        //$('#quizHTML-' + key).html(data);
                        $('#quizHTML-' + key).hide();
                        $('.material-plquiz-' + key).hide();
                        $('.material-nxquiz-' + key).show();
                        $('.material-nxtqz-' + key).hide();
                        $('.material-submitqz-' + key).show();
                        $('.material-nxtqz2-' + key).hide();
                        $('.material-submitqz2-' + key).hide();
                        $.unblockUI();
                    }
                });
            }
        }
    }

    function getQuizMaterialSubmit(enrollment_id, id, key, total) {
        var x = $('#quiz-form-' + key).serializeArray();
        var input = document.getElementsByName('questions-' + key + '[]');
        var optionArray = [];
        for (var i = 0; i < input.length; i++) {
            var qId = input[i].value;
            var optId = 'que-' + key + '-' + qId;
            var ele = document.getElementsByName('que-' + key + '-' + qId);
            const radioButtons = document.querySelectorAll('input[name=' + optId + ']');
            let selectedOptions;
            for (j = 0; j < ele.length; j++) {
                if (ele[j].checked) {
                    // alert(" Question" + qId + " Answer: "+ele[j].value);
                    optionArray.push({
                        id: qId,
                        choice: ele[j].value
                    });
                }
            }

            for (const radioButton of radioButtons) {
                if (radioButton.checked) {
                    selectedOptions = radioButton.value;
                    break;
                }
            }

            var output = selectedOptions ? selectedOptions : '';

            if (output == '') {
                optionArray.push({
                    id: qId,
                    choice: ""
                });
            }
        }

        if (typeof optionArray !== 'undefined' && optionArray.length > 0) {
            console.log(optionArray);
            if (enrollment_id != '' && id != '') {
                var baseUrl = "<?= base_url(); ?>";
                $.ajax({
                    url: baseUrl + 'users/courseQuizMaterial',
                    type: 'POST',
                    data: {
                        enrollment_id: enrollment_id,
                        id: id,
                        key: key,
                        page: 'end',
                        optionArray: optionArray
                    },
                    beforeSend: function() {
                        $.blockUI({
                            css: {
                                border: 'none',
                                padding: '15px',
                                backgroundColor: '#000',
                                '-webkit-border-radius': '10px',
                                '-moz-border-radius': '10px',
                                opacity: .5,
                                color: '#fff'
                            }
                        });
                        setTimeout($.unblockUI, 2000);
                    },
                    success: function(data) {
                        // $('#quizHTML-' + key).empty();
                        $('#quizResultHTML-' + key).show();
                        $('#quizResultHTML-' + key).html(data);
                        //$('#quizHTML-' + key).html(data);
                        $('#quizHTML-' + key).hide();
                        $('.material-plquiz-' + key).hide();
                        $('.material-nxquiz-' + key).hide();
                        $('.material-nxtqz2-' + key).hide();
                        $('.material-submitqz2-' + key).show();
                        $.unblockUI();
                    }
                });
            }
        }
    }

    function getQuizTryAgain(enrollment_id, id, key) {
        $('#quizResultHTML-' + key).empty();
        $('#quizResultHTML-' + key).hide();
        $('#quizHTML-' + key).show();
        $('.material-plquiz-' + key).show();
        $('.material-nxquiz-' + key).hide();
        $('.material-nxtqz-' + key).show();
        $('.material-submitqz-' + key).hide();
    }

    function getSavedMaterial(enrollment_id, id) {
        if (enrollment_id != '' && id != '') {
            var baseUrl = "<?= base_url(); ?>";
            $.ajax({
                url: baseUrl + 'users/completedMaterial',
                type: 'POST',
                data: {
                    enrollment_id: enrollment_id,
                    id: id
                },
                beforeSend: function() {
                    $.blockUI({
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });
                    setTimeout($.unblockUI, 2000);
                },
                success: function(data) {
                    // $('#quizHTML-' + key).html(data);
                    $.unblockUI();
                }
            });
        }
    }

    function gotoListingModule(id) {
        if (gotoListingModule) {
            window.location.href = "<?= base_url(); ?>" + 'users/courseModule/' + id;
        }
    }

    function getPrevMaterial(key) {
        $('.nextbtnClass').hide();
        $('.prevbtnClass').hide();
        $('.submitbtn').hide();
        var prev = parseInt(key) - 1;
        if (key > 1) {
            $('#prevbtn-' + prev).show();
            $('#nextbtn-' + prev).show();
            $('.materialpr-' + prev).show();
            $('.matcommon').removeClass('disabled');
            $('.matcommonPrv').removeClass('disabled');
        }

        if (prev == 1) {
            $('.materialpr-' + prev).hide();
            $('#nextbtn-' + prev).show();
            $('#submitbtn-' + prev).hide();
        }
    }

    $('#reviewButton').click(function() {
        var course_id = $('#course_id').val();
        var message = $('#review_msg').val().trim();
        var ratingValue = $("input[name='rating']:checked").val();
        if (typeof ratingValue == 'undefined' && message == "") {
            $('#error').show();
            $('#error').text("Rating/Message is not empty!");
        } else if (course_id != '') {
            var baseUrl = "<?= base_url(); ?>";
            $.ajax({
                url: baseUrl + 'home/reviewSave',
                type: 'POST',
                data: {
                    course_id: course_id,
                    rating: ratingValue,
                    message: message
                },
                beforeSend: function() {
                    $('#error').hide();
                    $("#review-txt").hide();
                    $("#review-txt").text("");
                    $.blockUI({
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });
                    setTimeout($.unblockUI, 2000);
                },
                success: function(revdata) {
                    if (revdata == "0") {
                        $('#error').show();
                        $('#error').text("Sorry! Not allowed to posting again!");

                    } else {
                        $("#review-txt").show();
                        $("#review-txt").text("Your review is posted successfully!");
                        $('#review_msg').val("");
                        $('#rvCtn').text(revdata);
                        getReviews(course_id);
                    }
                    $.unblockUI();
                }
            });
        }
    });

    function getReviews(course_id) {
        var baseUrl = "<?= base_url(); ?>";
        if (course_id) {
            $.ajax({
                url: baseUrl + 'home/getAllReviews',
                type: 'POST',
                data: {
                    course_id: course_id,
                },
                beforeSend: function() {},
                success: function(revdata) {
                    $('#reviewHTML').html(revdata);
                }
            });
        }
    }

    $(".qs_image").click(function() {

        var id = $(this).attr("data-id");
        var img = $(this).attr("data-img");

        $(".show_image").html("<img src=" + img + " style='display: block;  margin-top: 5px; object-fit: cover; cursor: pointer;' alt='question-img'><a class='close-modal'>Close (x)</a>");
        $(".intro-section-Custom-Modal").addClass("modalshow");


        $(".close-modal").click(function() {
           
            $(".intro-section-Custom-Modal").removeClass("modalshow");
        });


    });
</script>
</body>

</html>