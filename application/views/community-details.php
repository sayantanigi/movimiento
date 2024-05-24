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
                            <img src="<?= base_url()?>uploads/profile_pictures/<?= $userdetails->image?>" />
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
                            <?php
                            $chechis_like = $this->db->query("SELECT * FROM community_like WHERE community_id = '".$community_data->id."' AND user_id = '".$this->session->userdata('user_id')."' AND is_liked = 1")->num_rows();
                            $countchechis_like = $this->db->query("SELECT COUNT(id) as count FROM community_like WHERE community_id = '".$community_data->id."' AND is_liked = 1")->row();
                            if($chechis_like > 0) { ?>
                            <li class="me-4"><a href="javascript:void(0)"><i class="fas fa-thumbs-up text-secondary change-color" onclick="dislikecommunity()"></i> <sup style="top: -2px;"><?= $countchechis_like->count?></sup></a></li>
                            <?php } else { ?>
                            <li class="me-4"><a href="javascript:void(0)"><i class="fas fa-thumbs-up text-secondary" onclick="likecommunity()"></i> <sup style="top: -2px;"><?= $countchechis_like->count?></sup></a></li>
                            <?php } ?>
                            <?php $commentCount = $this->db->query("SELECT count(id) as count FROM community_comment WHERE community_id = '".$community_data->id."'")->row(); ?>
                            <li><a href="javascript:void(0)"><i class="fas fa-comment text-secondary"></i> <sup style="top: -2px;"><?= $commentCount->count;?></sup></a></li>
                        </ul>
                    </div>
                </div>
                <div class="latest-comments mb-95">
                    <h3><?= $commentCount->count;?> Comments</h3>
                    <ul>
                        <?php
                        $commentList = $this->db->query("SELECT * FROM community_comment WHERE community_id = '".$community_data->id."' ORDER BY id DESC")->result_array();
                        if(!empty($commentList)) {
                        foreach ($commentList as $value) {
                        $userData = $this->db->query("SELECT * FROM users WHERE id = '".$value['user_id']."'")->row(); ?>
                        <li>
                            <div class="comments-box grey-bg">
                                <div class="comments-info d-flex">
                                    <div class="comments-avatar mr-20">
                                        <?php if(!empty($userData->image)) { ?>
                                        <img src="<?= base_url()?>uploads/profile_pictures/<?= $userData->image?>" />
                                        <?php } else { ?>
                                        <img src="<?= base_url()?>images/no-user.png" />
                                        <?php } ?>
                                    </div>
                                    <div class="avatar-name">
                                        <h5><?= $value['full_name']?></h5>
                                        <span class="post-meta"><?= date('M j, Y', strtotime($value['created_at']))?></span>
                                    </div>
                                </div>
                                <div class="comments-text ml-65">
                                    <p><?= $value['comment']?></p>
                                    <div class="comments-replay">
                                        <a href="javascript:void(0)" onclick="replyComment(<?= $value['id']?>)">Reply</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <?php
                        $commentRply = $this->db->query("SELECT * FROM community_comment_rply WHERE community_id = '".$community_data->id."' AND comment_id = '".$value['id']."'")->result_array();
                        if(!empty($commentRply)) {
                        foreach ($commentRply as $data) {
                        $userData1 = $this->db->query("SELECT * FROM users WHERE id = '".$data['user_id']."'")->row(); ?>
                            <li class="children">
                                <div class="comments-box grey-bg">
                                    <div class="comments-info d-flex">
                                        <div class="comments-avatar mr-20">
                                            <?php if(!empty($userData1->image)) { ?>
                                            <img src="<?= base_url()?>uploads/profile_pictures/<?= $userData1->image?>" />
                                            <?php } else { ?>
                                            <img src="<?= base_url()?>images/no-user.png" />
                                            <?php } ?>
                                        </div>
                                        <div class="avatar-name">
                                            <h5><?= $data['full_name']?></h5>
                                            <span class="post-meta"><?= date('M j, Y', strtotime($data['created_at']))?></span>
                                        </div>
                                    </div>
                                    <div class="comments-text ml-65">
                                        <p><?= $data['comment']?></p>
                                    </div>
                                </div>
                            </li>
                        <?php } } ?>
                        <?php } } else { ?>
                        <li>No comment yet</li>
                        <?php } ?>
                    </ul>
                </div>
                <?php if(!empty($this->session->userdata('user_id'))) {
                $getUser = $this->db->query("SELECT * FROM users WHERE id = '".$this->session->userdata('user_id')."'")->row();
                ?>
                <div class="blog__comment">
                    <h3>Write a Comment</h3>
                    <form action="#" id="contact-form">
                        <div class="row">
                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                <div class="blog__comment-input">
                                <input type="text" placeholder="Your Name" name="full_name" id="full_name" value="<?= $getUser->full_name?>" required readonly>
                                </div>
                            </div>
                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                <div class="blog__comment-input">
                                <input type="email" placeholder="Your Email" name="email" id="email" value="<?= $getUser->email?>" required readonly>
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div class="blog__comment-input">
                                <input type="text" placeholder="Website" name="website" id="website" value="">
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div class="blog__comment-input">
                                <textarea placeholder="Enter your comment ..." name="comment" id="comment"></textarea>
                                </div>
                            </div>
                            <!-- <div class="col-xxl-12">
                                <div class="blog__comment-agree d-flex align-items-center mb-20">
                                <input class="e-check-input" type="checkbox" id="e-agree">
                                <label class="e-check-label" for="e-agree">Save my name, email, and website in this browser for the next time I comment.</label>
                                </div>
                            </div> -->
                            <div class="col-xxl-12">
                                <div class="blog__comment-btn">
                                    <button type="button" class="e-btn" onclick="postComment()">Post Comment</button>
                                    <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id')?>">
                                    <input type="hidden" name="community_id" id="community_id" value="<?= @$community_data->id?>">
                                    <input type="hidden" name="comment_id" id="comment_id" value="">
                                </div>
                            </div>
                            <div class="success_msg" style="color: #db3636; margin-top: 20px;"></div>
                        </div>
                    </form>
                </div>
                <?php } else { ?>
                <div class="blog__comment">Please <a href="<?= base_url()?>login" style="font-size: 16px; color: #4853ff !important; cursor: pointer;">login</a> in to write comment
                <?php } ?>
            </div>
        </div>
    </div>
</section>
<style>
    .change-color:before {
        color: #5fe0d0;
    }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
function postComment() {
    var user_id = $('#user_id').val();
    var community_id = $('#community_id').val();
    var comment_id = $('#comment_id').val();
    var full_name = $('#full_name').val();
    var email = $('#email').val();
    var website = $('#website').val();
    var comment = $('#comment').val();
    $.ajax({
        url: "<?= base_url()?>home/postComment",
        type: "POST",
        data: {user_id: user_id, community_id: community_id, comment_id: comment_id, full_name: full_name, email: email, website: website, comment: comment},
        success: function (data) {
            //console.log(data);
            $('.success_msg').text(data);
            $('#contact-form')[0].reset();
            setTimeout(() => {
                location.reload();
            }, 3000);
        }
    })
}
function likecommunity() {
    var user_id = $('#user_id').val();
    var community_id = $('#community_id').val();
    $('.fa-thumbs-up').addClass('change-color');
    $.ajax({
        url: "<?= base_url()?>home/likecommunity",
        type: "POST",
        data: {user_id: user_id, community_id: community_id},
        success: function (data) {
            console.log(data);
            location.reload();
        }
    })
}
function dislikecommunity() {
    var user_id = $('#user_id').val();
    var community_id = $('#community_id').val();
    $('.fa-thumbs-up').removeClass('change-color');
    $.ajax({
        url: "<?= base_url()?>home/dislikecommunity",
        type: "POST",
        data: {user_id: user_id, community_id: community_id},
        success: function (data) {
            console.log(data);
            location.reload();
        }
    })
}
function replyComment(id) {
    $('html, body').animate({scrollTop: $(".blog__comment").offset().top - 180 }, 0);
    $('#comment_id').val(id)
}
</script>