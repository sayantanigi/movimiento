<main>
    <section class="signup__area po-rel-z1 pt-150 pb-100" style="background: #007599;">
        <div class="container">
            <div class="">
                <div class="row">
                    <div class="col-lg-6 text-white">
                        <h5 class="text-success dash-before mb-4">MAKUTANO YOUTH</h5>
                        <h2 class="h1 fw-bold mb-3">UN PONT ENTRE GÉNÉRATIONS.</h2>
                        <p>Makutano Youth is an engagement platform specifically dedicated to young professionals.
                            Throughout the year, it offers tools, content and events designed to support future leaders
                            in their success stories. These initiatives include workshops, masterclasses, webinars and
                            networking opportunities.</p>
                        <p>In addition, the Makutano Youth Forum and Makutano Young Generation talks have been
                            successful in inspiring and guiding tomorrow's leaders.</p>
                        <a href="#" class="btn btn-success py-3 text-uppercase px-4 mt-4">Join the Youth Network</a>
                    </div>
                    <div class="col-lg-6">
                        <div class="youthbanner">
                            <div class="owl-carousel owl-theme" id="youthslide1">
                                <div class="item"><img src="<?= base_url()?>assets/img/makutano-youth-1-1.jpg" /></div>
                                <div class="item"><img src="<?= base_url()?>assets/img/makutano-youth-2-1.jpg" /></div>
                                <div class="item"><img src="<?= base_url()?>assets/img/makutano-youth-3-1.jpg" /></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 text-white">
                    <h3 class="h4 text-success dash-before fw-bold mb-3">GOAL:</h3>
                    <ul class="mb-30 listdots">
                        <li>Create the bridge between the youth and the CEOs of Makutano.</li>
                        <li>Supervise and give young people the opportunity to meet CEOs or influential personalities
                            capable of supporting their projects.</li>
                    </ul>

                    <h3 class="h4 text-success dash-before fw-bold mb-3">MAKUTANO FOR YOUTH AIMS AS TARGETS:</h3>
                    <ul class="mb-30 listdots">
                        <li>Anyone from 18 to 35 years old</li>
                        <li>Young entrepreneurs</li>
                        <li>Young professionals</li>
                        <li>Young talents</li>
                        <li>Young students in universities, various training centers and institutes.</li>
                    </ul>
                    <p>We are expanding our target so that every young person finds his interest in the Makutano for
                        Youth network.</p>
                </div>
                <div class="col-lg-6">
                    <div class="bg-dark p-4 shadow-lg text-white">
                        <div class="text-center text-white ">
                            <h4 class="h4 fw-bold mb-3">BECOME A MEMBER OF THE MAKUTANO FOR YOUTH NETWORK</h4>
                            <p class="mb-0">Makutano for Youth is a platform dedicated to young people.</p>
                            <p>Join our network and receive notification of our activities.</p>
                        </div>
                        <?php //print_r($this->session->flashdata());?>
                        <form action="<?= base_url()?>Home/submitYouthForm" method="post">
                            <div class="row g-3">
                                <div class="col-lg-6">
                                    <div class="contact__form-input ">
                                        <input type="text" placeholder="Your First Name" class=" mb-0" name="fname" id="fname" required> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact__form-input ">
                                        <input type="text" placeholder="Your Last Name" class=" mb-0" name="lname" id="lname" required> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact__form-input">
                                        <input type="email" placeholder="Your Email Address" class=" mb-0" name="email" id="email"> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact__form-input">
                                        <input type="text" placeholder="Contact Number" class="  mb-0" name="contactno" id="contactno" required> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact__form-input">
                                        <input type="text" placeholder="Your Age" class="  mb-0" name="age" id="age" required> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact__form-input">
                                        <input type="text" placeholder="Town of residence" class="  mb-0" name="town" id="town" required> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact__form-input">
                                        <input type="text" placeholder="Activity Area" class="  mb-0" name="area" id="area" required> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact__form-input">
                                        <input type="text" placeholder="Name of your company" class="  mb-0" name="company" id="company" required> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact__form-input">
                                        <input type="text" placeholder="Your training or diploma" class="mb-0" name="qualification" id="qualification" required> 
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact__form-input">
                                        <select class="mb-0" name="statute" id="statute" required> 
                                            <option>Your Statute...</option>
                                            <option>Student</option>
                                            <option>Employee</option>
                                            <option>Entrepreneur</option>
                                            <option>Looking for a job</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <p class="mb-1">Your interest in Makutano</p>
                                    <div><label><input type="checkbox" name="interest[]" id="interest" value="Networking"> Networking</label></div>
                                    <div><label><input type="checkbox" name="interest[]" id="interest" value="Mentoring"> Mentoring</label></div>
                                    <div><label><input type="checkbox" name="interest[]" id="interest" value="Financement"> Financement</label></div>
                                    <div><label><input type="checkbox" name="interest[]" id="interest" value="Formation / Coaching"> Formation / Coaching</label></div>
                                </div>
                                <div class="col-lg-12 text-center">
                                    <button class="btn btn-success py-3 text-uppercase px-5">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <section class="pt-100 pb-100" style="background-color: #009470;">
        <div class="container">
            <h3 class="fw-bold text-center mb-3">ACTIVITIES</h3>
            <p class="text-white text-center mb-30">Makutano for Youth provides for all young people wishing to join the network:</p>
            <div class="row g-4">
                <?php if(!empty($youth_activity)) { 
                foreach ($youth_activity as $value) { ?>
                <div class="col-lg-6">
                    <div class=" text-white h-100 shadow-lg p-lg-5 p-4 text-center" style="background: #007599;">
                        <h4><?= $value['heading']?></h4>
                        <p class="mb-0"><?= $value['description']?></p>
                    </div>
                </div>
                <?php } } else { ?>
                <div class="col-lg-6">No data found</div>
                <?php } ?>
            </div>
        </div>
    </section>
    <section class="pt-100 pb-100">
        <div class="container">
            <div class="row g-2">
                <?php if(!empty($youth_portfolio)) { 
                foreach ($youth_portfolio as $row) { ?>
                <div class="col-lg-4 col-6">
                    <a href="<?= base_url()?>uploads/portfolio/<?= $row['image']?>" data-fancybox="group" class="galleryBox">
                        <img src="<?= base_url()?>uploads/portfolio/<?= $row['image']?>" />
                    </a>
                </div>
                <?php } } else { ?>
                <div class="col-lg-4 col-6">No data found</div>
                <?php } ?>
            </div>
        </div>
    </section>
</main>