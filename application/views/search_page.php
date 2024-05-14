<style>
    .zero {color: #ddd !important;}
</style>
<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="<?= base_url()?>assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                    <h3 class="page__title">Search Data</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= base_url()?>home">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Search Data</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="course__area pt-90 pb-70 grey-bg">
    <div class="container">
        <div class="row grid">
        <?php if(!empty($search_result)) {
            foreach ($search_result as $value) {
            $catname = $this->db->query("SELECT * FROM sm_category WHERE id = '".$value['cat_id']."'")->row(); ?>
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 grid-item cat1 cat2 cat4">
                <div class="course__item white-bg mb-30 fix">
                    <div class="course__thumb w-img p-relative fix">
                        <a href="<?=base_url('course-detail/'.@$value['id'])?>">
                        <?php if(!empty($value['image'])) { ?>
                        <img src="<?= base_url()?>assets/images/courses/<?= $value['image']?>" alt="">
                        <?php } else { ?>
                        <img src="assets/images/no-image.png" alt="">
                        <?php } ?>
                        </a>
                        <div class="course__tag">
                            <a href="javascript:void(0)"><?= $catname->category_name?></a>
                        </div>
                    </div>
                    <div class="course__content">
                        <div class="course__meta d-flex align-items-center justify-content-between">
                            <div class="course__lesson">
                            <?php
                                $module = $this->db->query("SELECT count(id) as total_module FROM course_modules WHERE course_id = '".$value['id']."'")->row();
                                if(!empty($module)) {
                                    $count = $module->total_module;
                                } else {
                                    $count = '0';
                                }
                                ?>
                                <span><i class="far fa-book-alt"></i><?= $count;?> Lesson</span>
                            </div>
                            <div class="course__rating">
                            <?php
                            $rating = $this->db->query("SELECT * FROM course_reviews WHERE course_id = '".$value['id']."'")->result_array();
                            $totalrate = $this->db->query("SELECT SUM(rating) as total FROM course_reviews WHERE course_id = '".$value['id']."'")->row();
                            if(!empty($rating)) {
                            $rate = round($totalrate->total/count($rating), 0);
                            foreach (range(1,5) as $i) {
                            if($rate > 0) { ?>
                            <span class="active"><i class="fas fa-star"></i></span>
                            <?php } else { ?>
                            <span><i class="fas fa-star"></i></span>
                            <?php } $rate--; } ?>
                            <?php } else { ?>
                            <span><i class="fas fa-star zero"></i></span>
                            <span><i class="fas fa-star zero"></i></span>
                            <span><i class="fas fa-star zero"></i></span>
                            <span><i class="fas fa-star zero"></i></span>
                            <span><i class="fas fa-star zero"></i></span>
                            <?php } echo "(0)";
                            ?>
                            </div>
                        </div>
                        <h3 class="course__title"><a href="<?=base_url('course-detail/'.@$value['id'])?>"><?= $value['title']?></a></h3>
                        <?php if(!empty($value['user_id'])) {
                        $user_details = $this->db->query("SELECT id, full_name, image FROM users WHERE id = '".$value['user_id']."' AND email_verified = '1' AND status = '1'")->row();?>
                        <div class="course__teacher d-flex align-items-center">
                            <div class="course__teacher-thumb mr-15">
                                <?php if(!empty($user_details->image)) { ?>
                                <img src="<?= base_url() ?>uploads/users/<?= $user_details->image?>" alt="">
                                <?php } else { ?>
                                <img src="<?= base_url() ?>images/no-user.png" alt="">
                                <?php } ?>
                            </div>
                            <h6><a href="javascript:void(0)"><?= $user_details->full_name?></a></h6>
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
                        <div class="course__status">
                        <?php if($value['course_fees'] == 'free') { ?>
                            <span><?= ucwords($value['course_fees'])?></span>
                            <?php } else { ?>
                            <span><?= "$". ucwords($value['price'])?></span>
                            <?php } ?>
                        </div>
                        <div class="course__btn">
                            <a href="<?=base_url('course-detail/'.@$value['id'])?>" class="link-btn">
                                Know Details
                                <i class="far fa-arrow-right"></i>
                                <i class="far fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } else { ?>
            <p style="font-size: larger; color: #d3e0d4; text-align: center;">No course found related to your keyword</p>
            <?php } ?>
        </div>
        <?php
        $countCourse = $this->db->query("SELECT COUNT(id) as id FROM courses WHERE status = '1'")->row();
        if($countCourse->id > 9) { ?>
        <div style="text-align: center;"><a href="<?php echo base_url()?>course-list" class="e-btn e-btn-border-2">View All Course</a></div>
        <?php } ?>
    </div>
</section>