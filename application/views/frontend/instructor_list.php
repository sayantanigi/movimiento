<?php
$getCourse = $this->db->query("SELECT * FROM courses WHERE id = '".$course_id."'")->row();
?>
<section class="enrollPnl">
    <div class="container">
        <h2 class="subtitle  wow fadeInUp">Instructor List</h2>
        <h3 class="maintitle mb-5  wow fadeInUp">Book an Instructor</h3>
        <input type="hidden" id="course_id" name="course_id" value="<?= $course_id; ?>">
        <div class="row gutter-y-30">
            <?php if(!empty($instructor_list)) {
            foreach ($instructor_list as $instructor) { ?>
            <div class="col-md-6 col-lg-4">
                <div class="team-card wow fadeInUp" data-wow-duration='1500ms' data-wow-delay='000ms'>
                    <div class="team-card__image">
                        <?php if(!empty($instructor->image) && file_exists('uploads/trainer/profilePic/'.$instructor->image)) { ?>
                        <img src="<?= base_url()?>uploads/trainer/profilePic/<?= $instructor->image; ?>" alt="<?= $instructor->salutation." ".$instructor->first_name." ".$instructor->last_name?>">
                        <?php } else { ?>
                        <img src="<?= base_url()?>uploads/default_profile.jpg" alt="<?= $instructor->salutation." ".$instructor->first_name." ".$instructor->last_name?>">
                        <?php } ?>
                    </div>
                    <div class="team-card__content">
                        <h3 class="team-card__title">
                            <a href="<?= base_url()?>instructor-details?ctitle=<?= base64_encode($getCourse->course_name); ?>&insid=<?= base64_encode($instructor->id)?>"> <?= $instructor->salutation." ".$instructor->first_name." ".$instructor->last_name?></a>
                        </h3>
                        <div class="d-flex justify-content-between relative">
                            <div>
                                <h6 class="team-card__designation">Instructor</h6>
                                <div class="ratings mt-2">
                                    <i class="fas fa-star active"></i>
                                    <i class="fas fa-star active"></i>
                                    <i class="fas fa-star active"></i>
                                    <i class="fas fa-star active"></i>
                                    <i class="fas fa-star active"></i>
                                </div>
                            </div>
                            <div>
                                <a href="<?= base_url()?>instructor-slot?ctitle=<?= base64_encode($getCourse->course_name)?>&uid=<?= base64_encode($user_id)?>&insid=<?= base64_encode($instructor->id)?>" class="btn btn-sm btn-danger">Book Now</a>
                            </div>
                        </div>
                        <div class="team-card__content-shape">
                            <svg width="60" height="90" viewBox="0 0 60 90" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M63 0L0 90H63V0Z" fill="" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</section>