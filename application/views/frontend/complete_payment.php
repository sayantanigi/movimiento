<?php
$site_setting = $this->db->query("select * from  settings")->row();
?>
<section class="enrollPnl">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-1"></div>
            <div class="col-lg-10" style="text-align: center;">
                <div class="text-success-msg f-20">
                    <?php if ($this->session->flashdata('message')) {
                        echo '<h3 class="h3 fw-bold mb-2  wow fadeInUp" style="text-align: center; font-size: 18px; padding: 10px; background: green; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('message').'</h3>';
                        unset($_SESSION['message']);
                    } ?>
                    <?php if ($this->session->flashdata('error')) {
                        echo '<h3 class="h3 fw-bold mb-2  wow fadeInUp" style="text-align: center; font-size: 18px; padding: 10px; background: red; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('error').'</h3>';
                        unset($_SESSION['error']);
                    } ?>
                </div>
                <?php if(!empty($_SESSION['bayhill']['user_id'])) {
                    $url = base_url('dashboard');
                } else {
                    $url = base_url('login');
                } ?>
                <h2 class="maintitle text-black mb-4">Success! Your Purchase Was Successful</h2>
                <p>Thank you for purchasing the <b><?= $course_title; ?></b>! You're now officially enrolled and ready to start your learning journey.</p>
                <p>You can access the course content immediately by visiting your <a style="color: #104597;" href="<?= $url?>"><b>dashboard</b></a>. We’re excited to have you on board and can’t wait to help you achieve your goals!</p>
                <p>If you have any questions or need support, feel free to reach out to us on <a style="color: #104597;" href="mailto:<?= $site_setting->email?>"><b><?= $site_setting->email?></b></a>. Happy learning!</p>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</section>
<section class="whychoose" style="background-image: url(./assets/images/serv-bg-03.jpg);">
    <div class="container">
        <div class="row g-5 justify-content-center align-items-center">
            <div class="col-lg-10 text-center">
                <h2 class="maintitle text-white mb-4">Why Take California Driver Ed With Us?</h2>
                <p>Bayhill Driving school established in 2013, have designed an Driving Lessons proven to give you quality driver education, provides a solid foundation of knowledge and skills that can help you to become a safe driver in California. Instructors are fully licensed by the State of California with extensive Behind The Wheel experience. We pride ourselves on providing a patient and supportive style when working with both teens and adults. Each instructor is License and approved by the DMV. All our Instructors act in a professional and courteous manner when giving instructions.</p>
                <div class="mt-5">
                    <a href="<?= base_url()?>faq" class="enrollbtn text-uppercase">Course FAQ</a>
                </div>
            </div>
        </div>
    </div>
</section>