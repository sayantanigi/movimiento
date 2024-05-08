<main>
    <section class="signup__area po-rel-z1 pt-100 pb-145">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2 mt-50">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">Blog</h2>
                        <nav>
                            <ol class="breadcrumbnav mb-lg-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Blog</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php
                if(!empty($blogList)) {
                foreach ($blogList as $val) { ?>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6">
                    <div class="blog__item white-bg mb-30 transition-3 fix">
                        <div class="blog__thumb w-img fix">
                            <a href="<?= base_url() ?>blog-details/<?= $val['slug']?>">
                                <img src="<?= base_url() ?>uploads/blog/<?= $val['image']?>" alt="" style="height: 250px;">
                            </a>
                        </div>
                        <div class="blog__content">
                            <h3 class="blog__title"><a href="<?= base_url() ?>blog-details/<?= $val['slug']?>"><?= $val['title']?></a>
                            </h3>

                            <div class="blog__meta d-flex align-items-center justify-content-between">
                            <?php if(!empty($val['uploaded_by'])) { 
                                $user_details = $this->db->query("SELECT id, fname, lname, image FROM users WHERE id = '".$val['uploaded_by']."'")->row();?>
                                <div class="blog__author d-flex align-items-center">
                                    <div class="blog__author-thumb mr-10">
                                        <?php if(!empty($user_details->image)) { ?>
                                        <img src="<?= base_url() ?>uploads/users/<?= $user_details->image?>" alt="">
                                        <?php } else { ?>
                                        <img src="<?= base_url() ?>images/no-user.png" alt="">
                                        <?php } ?>
                                    </div>
                                    <div class="blog__author-info">
                                        <h5><a href="javascript:void(0)"><?= $user_details->fname." ".$user_details->lname?></a></h5>
                                    </div>
                                </div>
                                <?php } else { ?>
                                <div class="course__teacher d-flex align-items-center">
                                    <div class="course__teacher-thumb mr-15">
                                        <img src="<?= base_url() ?>assets/img/favicon.png" alt="">
                                    </div>
                                    <h6><a href="javascript:void(0)">Admin</a></h6>
                                </div>
                                <?php } ?>
                                <div class="blog__date d-flex align-items-center">
                                    <i class="fal fa-clock"></i>
                                    <span><?= date("M jS, Y", strtotime($val['created_at']))?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } } ?>
                </div>
        </div>
    </section>
</main>