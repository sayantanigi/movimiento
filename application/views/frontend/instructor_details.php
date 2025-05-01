<?php
$getinstructor_data = $this->db->query("SELECT * FROM users WHERE id = '".$instructorID."'")->row();
?>
<section class="team-details">
    <div class="container">
        <h3 class="maintitle mb-5  wow fadeInUp">Instructor Details</h3>
        <div class="team-details__inner">
            <div class="row">
                <div class="col-md-5 pe-3 pe-md-0">
                    <div class="team-details__image  wow fadeInLeft" data-wow-delay='500ms'>
                        <img src="assets/images/serv-bg-05.jpg" alt="team-details__image">
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="team-details__content">
                        <h6 class="team-details__content__subtitle  wow fadeInUp" data-wow-delay='500ms'>Instructor</h6>
                        <h3 class="team-details__content__title  wow fadeInUp" data-wow-delay='500ms'><?= $getinstructor_data->salutation." ".$getinstructor_data->first_name." ".$getinstructor_data->last_name; ?></h3>
                        <div class="ratings mb-3  wow fadeInUp">
                            <i class="fas fa-star active"></i>
                            <i class="fas fa-star active"></i>
                            <i class="fas fa-star active"></i>
                            <i class="fas fa-star active"></i>
                            <i class="fas fa-star active"></i>
                        </div>
                        <p class="team-details__content__text  wow fadeInUp" data-wow-delay='500ms'><?= @$getinstructor_data->about; ?></p>
                        <ul class="list-unstyled team-details__list  wow fadeInUp" data-wow-delay='500ms'>
                            <li class="team-details__list__item"><i class="fas fa-briefcase"></i><span class="team-details__list__item__name">Experience:</span> <?= @$getinstructor_data->experience; ?></li>
                            <li class="team-details__list__item"><i class="icon-envelope"></i><span class="team-details__list__item__name">Email:</span><a href="mailto:<?= @$getinstructor_data->email; ?>"> <?= @$getinstructor_data->email; ?></a></li>
                            <li class="team-details__list__item"><i class="icon-telephone-call-1"></i><span class="team-details__list__item__name">Phone:</span><a href="tel:+8801775-338747"><?= @$getinstructor_data->phone; ?></a></li>
                        </ul>
                        <div class="team-skills  wow fadeInUp" data-wow-delay='500ms'>
                            <?php if(!empty(@$getinstructor_data->skills)) {
                            $skills = unserialize(@@$getinstructor_data->skills);
                            $rows=1;
                            foreach ($skills as $key) { ?>
                            <div class="team-skills__progress">
                                <h4 class="team-skills__progress__title"><?= $key['skills']; ?></h4>
                                <div class="team-skills__progress__bar">
                                    <div class="team-skills__progress__inner count-bar" data-percent="<?= $key['rating']; ?>%">
                                        <div class="team-skills__progress__number count-text"><?= $key['rating']; ?>%</div>
                                    </div>
                                </div>
                            </div>
                            <?php } } ?>
                        </div>
                        <a href="<?php base_url()?>instructor-slot" class="drivschol-btn drivschol-btn--base">Book Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>