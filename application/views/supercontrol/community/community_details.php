<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
<style>
#sample_1_filter {padding: 8px;float: right;}
#sample_1_length {padding: 8px;}
#sample_1_info {padding: 8px;}
#sample_1_paginate {float: right; padding: 8px;}
.dataTables_info {padding: 7px;}
.showcase_buttons .btn.btn-outline.green { width: 100%; margin: 0 0 5px 0;}
.showcase_buttons .btn.btn-outline.red {width: 100%;}
</style>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <?php $this->load->view('supercontrol/leftbar'); ?>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li><a href="<?php echo base_url(); ?>supercontrol/home">Home</a><i class="fa fa-circle"></i> </li>
                    <li><span>Supercontrol Panel</span> <i class="fa fa-circle"></i></li>
                    <li><span>Community Details</span></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed showcase_buttons">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i> Community Details </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="table-responsive">
                                            <div class="container" style="padding: 0;display: inline;">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="communityList d-flex p-3 mb-3" style="border-bottom: none !important;">
                                                            <div class="userComInfo" style="padding: 10px 10px 0px 10px; border: 2px solid #5fe0d0;">
                                                                <h2 class="h4 fw-bold communitytitle"><?= @$community_data->title ?></h2>
                                                                <div><?= @$community_data->description ?></div>
                                                                <span class="post-meta mb-2 d-block text-secondary">Posted on: <small><?= date('M j, Y', strtotime($community_data->created_at)) ?></small></span>
                                                                <ul class="d-flex align-items-center mt-3">
                                                                    <?php
                                                                    $chechis_like = $this->db->query("SELECT * FROM community_like WHERE community_id = '" . $community_data->id . "' AND user_id = '" . $this->session->userdata('user_id') . "' AND is_liked = 1")->num_rows();
                                                                    $countchechis_like = $this->db->query("SELECT COUNT(id) as count FROM community_like WHERE community_id = '" . $community_data->id . "' AND is_liked = 1")->row();
                                                                    if ($chechis_like > 0) { ?>
                                                                    <li class="me-4" style=" width: 50px; display: inline-block; float: left; "><a href="javascript:void(0)"><i class="fa fa-thumbs-up text-secondary change-color" onclick="dislikecommunity()"></i> <sup style="top: -2px;"><?= $countchechis_like->count ?></sup></a></li>
                                                                    <?php } else { ?>
                                                                    <li class="me-4" style=" width: 50px; display: inline-block; float: left; "><a href="javascript:void(0)"><i class="fa fa-thumbs-up text-secondary" onclick="likecommunity()"></i> <sup style="top: -2px;"><?= $countchechis_like->count ?></sup></a></li>
                                                                    <?php } ?>
                                                                    <?php $commentCount = $this->db->query("SELECT count(id) as count FROM community_comment WHERE community_id = '" . $community_data->id . "'")->row(); ?>
                                                                    <li><a href="javascript:void(0)"><i class="fa fa-comment text-secondary"></i> <sup style="top: -2px;"><?= $commentCount->count; ?></sup></a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="latest-comments mb-95">
                                                            <h3><?= $commentCount->count; ?> Comments</h3>
                                                            <ul>
                                                            <?php
                                                            $commentList = $this->db->query("SELECT * FROM community_comment WHERE community_id = '" . $community_data->id . "' ORDER BY id DESC")->result_array();
                                                            if (!empty($commentList)) {
                                                                foreach ($commentList as $value) {
                                                                $userData = $this->db->query("SELECT * FROM users WHERE id = '" . $value['user_id'] . "'")->row(); ?>
                                                                <li>
                                                                    <div class="comments-box grey-bg">
                                                                        <div class="comments-info d-flex">
                                                                            <div class="comments-avatar mr-20">
                                                                            <?php if (!empty($userData->image)) { ?>
                                                                                <img src="<?= base_url() ?>uploads/profile_pictures/<?= $userData->image ?>" />
                                                                            <?php } else { ?>
                                                                                <img src="<?= base_url() ?>images/no-user.png" />
                                                                            <?php } ?>
                                                                            </div>
                                                                            <div class="avatar-name">
                                                                                <h5><?= $value['full_name'] ?></h5>
                                                                                <span class="post-meta"><?= date('M j, Y', strtotime($value['created_at'])) ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="comments-text ml-65">
                                                                            <p><?= $value['comment'] ?></p>
                                                                            <div class="comments-replay">
                                                                                <a href="javascript:void(0)" onclick="replyComment(<?= $value['id'] ?>)">Reply</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                                $commentRply = $this->db->query("SELECT * FROM community_comment_rply WHERE community_id = '" . $community_data->id . "' AND comment_id = '" . $value['id'] . "'")->result_array();
                                                                if (!empty($commentRply)) {
                                                                foreach ($commentRply as $data) {
                                                                $userData1 = $this->db->query("SELECT * FROM users WHERE id = '" . $data['user_id'] . "'")->row(); ?>
                                                                <li class="children">
                                                                    <div class="comments-box grey-bg">
                                                                        <div class="comments-info d-flex">
                                                                            <div class="comments-avatar mr-20">
                                                                                <?php if (!empty($userData1->image)) { ?>
                                                                                <img src="<?= base_url() ?>uploads/profile_pictures/<?= $userData1->image ?>" />
                                                                                <?php } else { ?>
                                                                                <img src="<?= base_url() ?>images/no-user.png" />
                                                                                <?php } ?>
                                                                            </div>
                                                                            <div class="avatar-name">
                                                                                <h5><?= $data['full_name'] ?></h5>
                                                                                <span class="post-meta"><?= date('M j, Y', strtotime($data['created_at'])) ?></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="comments-text ml-65">
                                                                            <p><?= $data['comment'] ?></p>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php } } } } else { ?>
                                                                <li>No comment yet</li>
                                                                <?php } ?>
                                                            </ul>
                                                            <input type="hidden" name="comm_id" id="comm_id" value="<?= @$community_data->id ?>">
                                                        </div>
                                                        <?php
                                                        if (!empty($this->session->userdata('user_id'))) {
                                                        $getUser = $this->db->query("SELECT * FROM users WHERE id = '" . $this->session->userdata('user_id') . "'")->row();
                                                        ?>
                                                        <div class="blog__comment">
                                                            <h3>Write a Comment</h3>
                                                            <form action="#" id="contact-form">
                                                                <div class="row">
                                                                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                        <div class="blog__comment-input">
                                                                            <input type="text" placeholder="Your Name" name="full_name" id="full_name" value="<?= $getUser->full_name ?>" required readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                                                                        <div class="blog__comment-input">
                                                                            <input type="email" placeholder="Your Email" name="email" id="email" value="<?= $getUser->email ?>" required readonly>
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
                                                                    <div class="col-xxl-12">
                                                                        <div class="blog__comment-btn">
                                                                            <button type="button" class="e-btn" onclick="postComment()">Post Comment</button>
                                                                            <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id') ?>">
                                                                            <input type="hidden" name="community_id" id="community_id" value="<?= @$community_data->id ?>">
                                                                            <input type="hidden" name="comment_id" id="comment_id" value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="success_msg" style="color: #db3636; margin-top: 20px;"></div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <?php } else { ?>
                                                        <div class="blog__comment">Please <a href="<?= base_url() ?>login" style="font-size: 16px; color: #4853ff !important; cursor: pointer;">login</a> in to write comment</div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    $("#selectall").click(function () {
        var check = $(this).prop('checked');
        if (check == true) {
            $('.checker').find('span').addClass('checked');
            $('.checkbox1').prop('checked', true);
        } else {
            $('.checker').find('span').removeClass('checked');
            $('.checkbox1').prop('checked', false);
        }
    });
    $("#del_all").on('click', function (e) {
        e.preventDefault();
        var checkValues = $('.checkbox1:checked').map(function () {
            return $(this).val();
        }).get();
        console.log(checkValues);
        $.each(checkValues, function (i, val) {
            $("#" + val).remove();
        });
        $.ajax({
            url: '<?php echo base_url() ?>supercontrol/course/delete_multiple',
            type: 'post',
            data: 'ids=' + checkValues
        }).done(function (data) {
            $("#respose").html(data);
            var newurl = '<?php echo base_url() ?>supercontrol/course/show_course';
            window.location.href = newurl;
            $('#selectall').attr('checked', false);
        });
    });
    function resetcheckbox() {
        $('input:checkbox').each(function () {
            this.checked = false;
        });
    }
});
function f1(stat, id) {
    $.ajax({
        type: "get",
        url: "<?php echo base_url(); ?>supercontrol/blog/statusblog",
        data: { stat: stat, id: id }
    });
}
</script>
<?php //$this->load->view ('footer');?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
// for posting Comment
function postComment() {
    var user_id = $('#user_id').val();
    var community_id = $('#community_id').val();
    var comment_id = $('#comment_id').val();
    var full_name = $('#full_name').val();
    var email = $('#email').val();
    var website = $('#website').val();
    var comment = $('#comment').val();
    $.ajax({
        url: "<?= base_url() ?>home/postComment",
        type: "POST",
        data: { user_id: user_id, community_id: community_id, comment_id: comment_id, full_name: full_name, email: email, website: website, comment: comment },
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
// for liking Comment
function likecommunity() {
    var user_id = $('#user_id').val();
    var community_id = $('#community_id').val();
    $('.fa-thumbs-up').addClass('change-color');
    $.ajax({
        url: "<?= base_url() ?>home/likecommunity",
        type: "POST",
        data: { user_id: user_id, community_id: community_id },
        success: function (data) {
            console.log(data);
            location.reload();
        }
    })
}
// for disliking Comment
function dislikecommunity() {
    var user_id = $('#user_id').val();
    var community_id = $('#community_id').val();
    $('.fa-thumbs-up').removeClass('change-color');
    $.ajax({
        url: "<?= base_url() ?>home/dislikecommunity",
        type: "POST",
        data: { user_id: user_id, community_id: community_id },
        success: function (data) {
            console.log(data);
            location.reload();
        }
    })
}
// for reply each Comment
function replyComment(id) {
    $('html, body').animate({ scrollTop: $(".blog__comment").offset().top - 180 }, 0);
    $('#comment_id').val(id);
    $('.blog__comment h3').text("Write your Reply");
    $('.blog__comment-btn button').text("Post Reply");
    $(".blog__comment-input textarea").attr("placeholder", "Enter your reply");
}
</script>