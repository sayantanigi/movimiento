<main>
    <section class="pt-100 pb-145">
        <div class="container">
            <div class="row align-items-center mb-55 mt-50">
                <div class="col-lg-6">
                    <div class="section__title-wrapper ">
                        <h2 class="section__title">Courses</h2>
                        <nav>
                            <ol class="breadcrumbnav mb-lg-0">
                                <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Courses</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-6">
                    <!-- <div style="width: 200px;" class="ms-auto">
                        <label>Filter:</label>
                        <select class="form-control form-select">
                            <option>Select</option>
                            <option>Course Type 1</option>
                            <option>Course Type 2</option>
                        </select>
                    </div> -->
                </div>
            </div>
            <div class="pt-5">
                <div class="row">
                    <?php 
                    if(!empty($list)) {
                    foreach ($list as $key => $value) {
                        if (@$value->image && file_exists('./assets/images/courses/' . @$value->image)) {
                            $image = base_url('assets/images/courses/' . @$value->image);
                        } else {
                            $image = base_url('./images/noimage.jpg');
                        }
                        // Get Average Rating.
                        // $getAverageRatingSql = "SELECT ROUND(AVG(rating),1) as averageRating FROM `course_reviews` where `course_id` = '" . @$value->id . "'";
                        // $ratingRow = $this->db->query($getAverageRatingSql)->row();
                        // $averageRating = @$ratingRow->averageRating;
                        // $rating = @$ratingRow->averageRating;
                        // Total user enroll
                        $totalEnrolledSql = "SELECT * FROM `course_enrollment` WHERE `course_id` = '" . @$value->id . "' AND `payment_status` = 'COMPLETED'";
                        $totalEnrolledUsr = $this->db->query($totalEnrolledSql)->num_rows();
                        $catname = $this->db->query("SELECT * FROM sm_category WHERE id = '".$value->cat_id."'")->row();
                    ?>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                        <div class="course__item white-bg mb-30 fix">
                            <div class="course__thumb w-img p-relative fix">
                                <a href="<?=base_url('course-detail/'.@$value->id)?>">
                                    <img src="<?php echo @$image; ?>" alt="Course Image" style="height: 257px">
                                </a>
                                <div class="course__tag">
                                    <a href="javascript:void(0)"><?= $catname->category_name?></a>
                                </div>
                            </div>
                            <div class="course__content">
                                <div class="course__meta d-flex align-items-center justify-content-between">
                                    <div class="course__lesson">
                                        <?php 
                                        $module = $this->db->query("SELECT count(id) as total_module FROM course_modules WHERE course_id = '".$value->id."'")->row();
                                        if(!empty($module)) {
                                            $count = $module->total_module;
                                        } else {
                                            $count = '0';
                                        }
                                        ?>
                                        <span><i class="far fa-book-alt"></i><?= $count;?> Lesson</span>
                                    </div>
                                    <div class="productListRate">
                                    <?php 
                                    $rating = $this->db->query("SELECT * FROM course_reviews WHERE course_id = '".$value->id."'")->result_array();
                                    $totalrate = $this->db->query("SELECT SUM(rating) as total FROM course_reviews WHERE course_id = '".$value->id."'")->row();
                                    if(!empty($rating)) {
                                    $rate = round($totalrate->total/count($rating), 0); 
                                    foreach (range(1,5) as $i) { 
                                    if($rate > 0) { ?>
                                    <span class="active"><i class="fas fa-star"></i></span>
                                    <?php } else { ?>
                                    <span><i class="fas fa-star"></i></span>
                                    <?php } $rate--; } ?>
                                    <?php } else { ?>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <?php } echo "(0)";
                                    ?>
                                    </div>
                                </div>
                                <h3 class="course__title" style="font-size: 18px">
                                    <a href="<?=base_url('course-detail/'.@$value->id)?>"><?php if(@$value->title) { echo strip_tags($value->title); } ?></a>
                                </h3>
                                <?php if(!empty($value->user_id)) { 
                                $user_details = $this->db->query("SELECT id, fname, lname, image FROM users WHERE id = '".$value->user_id."' AND email_verified = '1' AND status = '1'")->row();?>
                                <div class="course__teacher d-flex align-items-center">
                                    <div class="course__teacher-thumb mr-15">
                                        <?php if(!empty($user_details->image)) { ?>
                                        <img src="<?= base_url() ?>uploads/users/<?= $user_details->image?>" alt="">
                                        <?php } else { ?>
                                        <img src="<?= base_url() ?>images/no-user.png" alt="">
                                        <?php } ?>
                                    </div>
                                    <h6><a href="javascript:void(0)"><?= $user_details->fname." ".$user_details->lname?></a></h6>
                                </div>
                                <?php } else { ?>
                                <div class="course__teacher d-flex align-items-center">
                                    <div class="course__teacher-thumb mr-15">
                                        <img src="<?= base_url() ?>assets/img/favicon.png" alt="">
                                    </div>
                                    <h6><a href="javascript:void(0)">Admin</a></h6>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="course__more d-flex justify-content-between align-items-center">
                                <div class="course__btn">
                                    <a href="<?= base_url('course-detail/'.@$value->id)?>" class="link-btn">
                                        Know Details
                                        <i class="far fa-arrow-right"></i>
                                        <i class="far fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } } ?>
                </div>
            </div>
        </div>
    </section>
</main>