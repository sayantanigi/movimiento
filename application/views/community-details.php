<section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="<?= base_url()?>assets/img/page-title/page-title-2.jpg">
    <div class="container">
        <div class="row">
            <div class="col-xxl-12">
                <div class="page__title-wrapper mt-100">
                <h3 class="page__title">Community</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Community</li>
                    </ol>
                </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="pt-100 pb-145">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="communityList  d-flex  p-3 mb-3">
                    <div class="userIcon-com me-3">
                    <?php
                    if(!empty(@$community_data->uploaded_by)) {
                        $userdetails = $this->db->query("SELECT * FROM users WHERE id = '".@$community_data->uploaded_by."'")->row();
                        $name = $userdetails->full_name;
                    } else {
                        $name = "Admin";
                    }
                    ?>
                    <a href="javascript:void(0)">
                        <?php if(!empty($userdetails->image)) { ?>
                        <img src="<?= base_url()?>uploads/users/<?= $userdetails->image?>" />
                        <?php } else { ?>
                        <img src="<?= base_url()?>images/no-user.png" />
                        <?php } ?>
                    </a>
                    </div>
                    <div class="userComInfo">
                    <h6 class="fw-semibold mb-0"><a href="javascript:void(0)"><?= $name?></a></h6>
                    <span class="post-meta mb-2 d-block text-secondary"> <small><?= date('M j, Y', strtotime($community_data->created_at))?></small></span>
                    <h2 class="h4 fw-bold communitytitle"><?= @$community_data->title?></h2>
                    <div><?= @$community_data->description?></div>
                    <ul class="d-flex align-items-center mt-3">
                        <li class="me-4"><a href="#"><i class="fas fa-thumbs-up text-secondary"></i> <sup>10</sup></a></li>
                        <li><a href="#"><i class="fas fa-comment text-secondary"></i> <sup>3</sup></a></li>
                    </ul>
                    </div>
                </div>
                <div class="latest-comments mb-95">
                <h3>3 Comments</h3>
                <ul>
                    <li>
                        <div class="comments-box grey-bg">
                            <div class="comments-info d-flex">
                                <div class="comments-avatar mr-20">
                                        <img src="<?= base_url()?>assets/img/blog/comments/comment-1.jpg" alt="">
                                </div>
                                <div class="avatar-name">
                                    <h5>Eleanor Fant</h5>
                                    <span class="post-meta"> July 14, 2024</span>
                                </div>
                            </div>
                            <div class="comments-text ml-65">
                            <p>So I said lurgy dropped a clanger Jeffrey bugger cuppa gosh David blatant have it, standard A bit of how's your father my lady absolutely.</p>
                            <div class="comments-replay">
                                <a href="#">Reply</a>
                            </div>
                            </div>
                        </div>
                    </li>
                    <li class="children">
                        <div class="comments-box grey-bg">
                            <div class="comments-info d-flex">
                                <div class="comments-avatar mr-20">
                                        <img src="<?= base_url()?>assets/img/blog/comments/comment-1.jpg" alt="">
                                </div>
                                <div class="avatar-name">
                                    <h5>Dominic</h5>
                                    <span class="post-meta">April 16, 2024 </span>
                                </div>
                            </div>
                            <div class="comments-text ml-65">
                            <p>David blatant have it, standard A bit of how's your father my lady absolutely.</p>
                            <div class="comments-replay">
                                <a href="#">Reply</a>
                            </div>
                            </div>
                        </div>
                        <ul>
                            <li class="children-2">
                            <div class="comments-box grey-bg">
                                <div class="comments-info d-flex">
                                        <div class="comments-avatar mr-20">
                                            <img src="<?= base_url()?>assets/img/blog/comments/comment-3.jpg" alt="">
                                        </div>
                                        <div class="avatar-name">
                                        <h5>Von Rails</h5>
                                        <span class="post-meta">April 18, 2024 </span>
                                        </div>
                                </div>
                                <div class="comments-text ml-65">
                                    <p>He nicked it get stuffed mate spend a penny plastered.!</p>
                                    <div class="comments-replay">
                                        <a href="#">Reply</a>
                                    </div>
                                </div>
                            </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                </div>
                <div class="blog__comment">
                <h3>Write a Comment</h3>
                <form action="#">
                    <div class="row">
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="blog__comment-input">
                            <input type="text" placeholder="Your Name">
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-lg-6">
                            <div class="blog__comment-input">
                            <input type="email" placeholder="Your Email">
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="blog__comment-input">
                            <input type="text" placeholder="Website">
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="blog__comment-input">
                            <textarea placeholder="Enter your comment ..."></textarea>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="blog__comment-agree d-flex align-items-center mb-20">
                            <input class="e-check-input" type="checkbox" id="e-agree">
                            <label class="e-check-label" for="e-agree">Save my name, email, and website in this browser for the next time I comment.</label>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="blog__comment-btn">
                            <button type="submit" class="e-btn">Post Comment</button>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</section>