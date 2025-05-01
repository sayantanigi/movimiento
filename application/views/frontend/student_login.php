<section class="enrollPnl">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
                <div class="text-success-msg f-20">
                    <?php if ($this->session->flashdata('message')) {
                        echo '<p style="text-align: center; font-size: 18px; padding: 10px; background: green; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('message').'</p>';
                        unset($_SESSION['message']);
                    } ?>
                    <?php if ($this->session->flashdata('error')) {
                        echo '<p style="text-align: center; font-size: 18px; padding: 10px; background: red; border-radius: 20px; margin-bottom: 30px; color: #fff;">'.$this->session->flashdata('error').'</p>';
                        unset($_SESSION['error']);
                    } ?>
                </div>
                <h3 class="h3 fw-bold mb-2  wow fadeInUp">Login</h3>
                <form action="<?= base_url()?>login_process" method="POST">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label class="mb-2">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter your username" name="username" id="username" required/>
                        </div>
                        <div class="col-lg-12 col-md-12 mb-3">
                            <label class="mb-2">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" placeholder="Enter your password" name="password" id="password" required/>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <button class="enrollbtn">Sign In</button>
                        </div>
                        <div class="col-lg-6 mb-3" style="display: flex; flex-direction: row; flex-wrap: nowrap; justify-content: flex-end;">
                            <a href="<?= base_url()?>registration" class="enrollbtn">Create New Account</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-3"></div>
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