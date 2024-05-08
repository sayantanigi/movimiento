<main>
    <section class="signup__area po-rel-z1 pt-100 pb-145">
        <div class="container">
            <div class="section__title-wrapper mt-50 mb-30">
                <h2 class="section__title text-capitalize"><?= $blog_details->title?></h2>
                <nav>
                    <ol class="breadcrumbnav mb-lg-0">
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url()?>blog">Blog</a></li>
                        <li class="breadcrumb-item active"><a href="#"><?= $blog_details->title?></a></li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-30 text-white">
                    <div class="blog__img w-img mb-45">
                        <img src="<?= base_url() ?>uploads/blog/<?= $blog_details->image?>" alt="" style="height: 454px;">
                    </div>
                    <div><?= $blog_details->description?></div>
                </div>
                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <div class="blog__sidebar pl-70">

                        <div class="sidebar__widget mb-55">
                            <div class="sidebar__widget-head mb-35">
                                <h3 class="sidebar__widget-title">Recent posts</h3>
                            </div>
                            <div class="sidebar__widget-content">
                                <div class="rc__post-wrapper">
                                    <?php 
                                    $blogList = $this->db->query("SELECT * FROM blogs WHERE status='1'")->result_array();
                                    foreach ($blogList as $rp) { ?>
                                    <div class="rc__post d-flex align-items-center">
                                        <div class="rc__thumb mr-20">
                                            <a href="<?= base_url() ?>blog-details/<?= $rp['slug'] ?>">
                                                <img src="<?= base_url() ?>uploads/blog/<?= $rp['image'] ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="rc__content">
                                            <div class="rc__meta">
                                                <span><?= date('M jS, Y', strtotime($rp['created_at']))?></span>
                                            </div>
                                            <h6 class="rc__title"><a href="<?= base_url() ?>blog-details/<?= $rp['slug'] ?>" class="text-white"><?= $rp['title'] ?></a></h6>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>