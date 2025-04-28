<style>
    .zero {
        color: #ddd !important;
    }
</style>
<main>
    <section class="hero__area hero__height hero__height-2 d-flex align-items-center blue-bg-3 p-relative fix">
        <div class="hero__shape">
            <img class="hero-1-circle-2" src="assets/img/shape/hero/hero-1-circle-2.png" alt="">
            <img class="hero-1-dot-2" src="assets/img/shape/hero/hero-1-dot-2.png" alt="">
        </div>
        <div class="container">
            <div class="hero__content-wrapper mt-50">
                <div class="row align-items-center">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="hero__content hero__content-2 p-relative z-index-1">
                            <h3 class="hero__title hero__title-2">
                                Empower Your Learning Journey
                            </h3>
                            <h4>Unlock a World of Knowledge at Your Fingertips</h4>
                            <div class="hero__search mt-4">
                                <form action="<?= base_url('search_data') ?>" method="post">
                                    <div class="hero__search-input mb-10">
                                        <input type="text" name="search_data" placeholder="What do you want to learn?" value="">
                                        <button type="submit"><i class="fad fa-search"></i></button>
                                    </div>
                                </form>
                                <p>You`re guaranteed to find something that`s right for you.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="hero__thumb-wrapper mb--120">
                            <div class="hero__thumb-2 scene">
                                <img class="hero-big" src="assets/img/hero/hero-2/hero.png" alt="">
                                <img class="hero-shape-purple" src="assets/img/hero/hero-2/hero-shape-purple.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="category__area pt-90 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12">
                    <div class="section__title-wrapper mb-60">
                        <h2 class="section__title m-0">Explore Our Popular Categories</h2>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <a href="<?= base_url() ?>course_list" class="ViewAllBtn">
                        View all
                    </a>
                </div>
            </div>
            <div class="row">
                <?php if (!empty($category_list)) {
                    foreach ($category_list as $value) { ?>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                            <div class="category__item mb-30 transition-3 d-flex align-items-center">
                                <div class="category__icon" style="margin-right: 18px;">
                                    <?php if(!empty($value['category_image']) && file_exists('uploads/category/'.$value['category_image'])) { ?>
                                    <img src="<?= base_url() ?>uploads/category/<?= $value['category_image'] ?>" style="width: 45px; height: 45px;">
                                    <?php } else { ?>
                                    <img src="<?= base_url() ?>images/no_category.png" style="width: 45px; height: 45px;">
                                    <?php } ?>
                                </div>
                                <div class="category__content">
                                    <h4 class="category__title"><a href="<?= base_url()?>showCategoryWiseData/<?= $value['category_link'] ?>"><?= $value['category_name'] ?></a></h4>
                                    <p><?= $value['category_subtitle'] ?></p>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <p style="font-size: larger; color: #7c7e7d; text-align: center;">No category added yet</p>
                <?php } ?>
            </div>
        </div>
    </section>
    <!-- course area start -->
    <section class="course__area pt-90 pb-70 grey-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-10 col-sm-12">
                    <div class="section__title-wrapper mb-60">
                        <h2 class="section__title m-0">Find the Right Online Course for you</h2>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12">
                    <a href="<?= base_url() ?>course_list" class="ViewAllBtn">View all</a>
                </div>
            </div>
            <div class="row grid">
                <?php if (!empty($course_list)) {
                    foreach ($course_list as $value) {
                        $catname = $this->db->query("SELECT * FROM sm_category WHERE id = '" . $value->cat_id . "'")->row(); ?>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 grid-item cat1 cat2 cat4">
                            <div class="course__item white-bg mb-30 fix">
                                <div class="course__thumb w-img p-relative fix">
                                    <a href="<?= base_url('course-detail/'.@$value->id) ?>">
                                        <?php if (!empty($value->image) && file_exists('assets/images/courses/'.$value->image)) { ?>
                                            <img src="<?= base_url() ?>assets/images/courses/<?= $value->image ?>" alt="" style="width: 100%; height: 300px;">
                                        <?php } else { ?>
                                            <img src="<?= base_url() ?>assets/images/no-image.png" alt="">
                                        <?php } ?>
                                    </a>
                                    <div class="course__tag">
                                        <a href="javascript:void(0)"><?= $catname->category_name ?></a>
                                    </div>
                                </div>
                                <div class="course__content">
                                    <div class="course__meta d-flex align-items-center justify-content-between">
                                        <div class="course__lesson">
                                            <?php
                                            $module = $this->db->query("SELECT count(id) as total_module FROM course_modules WHERE course_id = '" . $value->id . "'")->row();
                                            if (!empty($module)) {
                                                $count = $module->total_module;
                                            } else {
                                                $count = '0';
                                            }
                                            ?>
                                            <span><i class="far fa-book-alt"></i><?= $count; ?> Lesson</span>
                                        </div>
                                        <div class="course__rating">
                                            <?php
                                            $rating = $this->db->query("SELECT * FROM course_reviews WHERE course_id = '" . $value->id . "'")->result_array();
                                            $totalrate = $this->db->query("SELECT SUM(rating) as total FROM course_reviews WHERE course_id = '" . $value->id . "'")->row();
                                            if (!empty($rating)) {
                                                $rate = round($totalrate->total / count($rating), 0);
                                                foreach (range(1, 5) as $i) {
                                                    if ($rate > 0) {
                                                        echo '<span class="active"><i class="fas fa-star"></i></span>';
                                                    } else {
                                                        echo '<span><i class="fas fa-star zero"></i></span>';
                                                    }
                                                    $rate--;
                                                }
                                                echo "(" . round($totalrate->total / count($rating), 0) . ")";
                                            } else {
                                                echo '<span><i class="fas fa-star zero"></i></span>';
                                                echo '<span><i class="fas fa-star zero"></i></span>';
                                                echo '<span><i class="fas fa-star zero"></i></span>';
                                                echo '<span><i class="fas fa-star zero"></i></span>';
                                                echo '<span><i class="fas fa-star zero"></i></span>';
                                                echo "(0)";
                                            } ?>
                                        </div>
                                    </div>
                                    <h3 class="course__title"><a href="<?= base_url('course-detail/' . @$value->id) ?>"><?= $value->title ?></a></h3>
                                    <?php if (!empty($value->user_id)) {
                                    $user_details = $this->db->query("SELECT id, full_name, image FROM users WHERE id = '" . $value->user_id . "' AND email_verified = '1' AND status = '1'")->row(); ?>
                                    <div class="course__teacher d-flex align-items-center">
                                        <div class="course__teacher-thumb mr-15">
                                            <?php if (!empty($user_details->image)) { ?>
                                                <img src="<?= base_url() ?>uploads/users/<?= $user_details->image ?>" alt="">
                                            <?php } else { ?>
                                                <img src="<?= base_url() ?>images/no-user.png" alt="">
                                            <?php } ?>
                                        </div>
                                        <h6><a href="javascript:void(0)"><?= $user_details->full_name ?></a></h6>
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
                                        <?php if ($value->course_fees == 'free') { ?>
                                            <span><?= ucwords($value->course_fees) ?></span>
                                        <?php } else { ?>
                                            <span><?= "$" . ucwords($value->price) ?></span>
                                        <?php } ?>
                                    </div>
                                    <div class="course__btn">
                                        <a href="<?= base_url('course-detail/' . @$value->id) ?>" class="link-btn">
                                            Know Details
                                            <i class="far fa-arrow-right"></i>
                                            <i class="far fa-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                } else { ?>
                    <p style="font-size: larger; color: #7c7e7d; text-align: center;">No course added yet</p>
                <?php } ?>
            </div>
            <?php
            $countCourse = $this->db->query("SELECT COUNT(id) as id FROM courses WHERE status = '1'")->row();
            if ($countCourse->id > 9) { ?>
                <div style="text-align: center;"><a href="<?php echo base_url() ?>course-list" class="e-btn e-btn-border-2">View All Course</a></div>
            <?php } ?>
        </div>
    </section>
    <!-- course area end -->
</main>