<link rel="stylesheet" href="<?= base_url() ?>assets/css/style.css">
<style>
#sample_1_filter {padding: 8px;float: right;}
#sample_1_length {padding: 8px;}
#sample_1_info {padding: 8px;}
#sample_1_paginate {float: right; padding: 8px;}
.dataTables_info {padding: 7px;}
.showcase_buttons .btn.btn-outline.green { width: 100%; margin: 0 0 5px 0;}
.showcase_buttons .btn.btn-outline.red {width: 100%;}
.comm_desc p{font-size: 14px !important; margin: 0 0 15px !important; line-height: 1.42857143 !important; color: #444;}

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
                    <li><span>Community Comment</span></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed showcase_buttons">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i> Community Comment</div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="table-responsive">
                                            <div class="container" style="padding: 0;display: inline;">
                                                <div class="row" style="margin: 0px !important; padding: 0px !important;">
                                                    <div class="col-lg-12">
                                                        <div class="communityList p-3 mb-3" style="border: 1px solid #eee; padding: 20px; border-radius: 20px !important; margin-top: 10px;">
                                                            <div class="userComInfo" style="padding: 0px 10px 0px 10px;">
                                                                <h2 class="h4 fw-bold communitytitle" style="text-align: center;font-weight: bold;background: #eee;padding: 20px;border-radius: 20px;">
                                                                <?php
                                                                $comment_id = $this->uri->segment($this->uri->total_segments());
                                                                $communityData = $this->db->query("SELECT * FROM community WHERE id = '".@$comment_id."'")->row();
                                                                echo $communityData->title;
                                                                ?>
                                                                </h2>
                                                                <div class="comm_desc">
                                                                    <label>Description: </label>
                                                                    <p> <?= $communityData->description?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="communityList" style="border: 1px solid #eee; padding: 10px; margin-top: 10px; border-radius: 20px !important;">
                                                            <div style="width: 100%;display: inline-block;text-align: center;margin: 20px 0;">
                                                                <?php
                                                                $community_cat = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result_array();
                                                                if(!empty($community_cat)){ ?>
                                                                <button type="button" class="btn btn-primary" onclick="getCatwisecommentData(0)">All</button>
                                                                <?php foreach($community_cat as $category) { ?>
                                                                <button type="button" class="btn btn-primary" onclick="getCatwisecommentData(<?= $category['id']?>)"><?= $category['category_name']?></button>
                                                                <?php } } ?>
                                                            </div>
                                                            <div class="latest-comments mb-95" id="latest-comments">
                                                            <?php
                                                                $getPinedData = $this->db->query("SELECT * FROM pin_comment WHERE community_id = '".@$comment_id."' AND pinned = '1' order by created_at DESC")->result();
                                                                if(!empty($getPinedData)) { ?>
                                                                <ul>
                                                                <?php
                                                                foreach ($getPinedData as $value) {
                                                                    $commentData = $this->db->query("SELECT * FROM community_comment WHERE id = '" . $value->comment_id . "'")->row();
                                                                    $userData = $this->db->query("SELECT * FROM users WHERE id = '" . $commentData->user_id . "'")->row(); ?>
                                                                    <li>
                                                                        <div class="comments-box grey-bg" style="padding: 10px !important; border-radius: 15px;">
                                                                            <div class="comments-info d-flex">
                                                                                <div class="comments-avatar mr-10">
                                                                                <?php if (!empty($userData->image)) { ?>
                                                                                    <img src="<?= base_url() ?>uploads/profile_pictures/<?= $userData->image ?>" />
                                                                                <?php } else { ?>
                                                                                    <img src="<?= base_url() ?>images/no-user.png" />
                                                                                <?php } ?>
                                                                                </div>
                                                                                <div class="avatar-name" style="margin-bottom: 2px;">
                                                                                    <h3 style="margin-top: 0px;font-weight: bold;margin-bottom: 2px;font-size: 16px;"><?= ucwords($commentData->full_name) ?></h3>
                                                                                    <span class="post-meta" style="font-size: 12px;"><?= date('M j, Y', strtotime($commentData->created_at)) ?> in
                                                                                    <?php
                                                                                    $cat_data = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result();
                                                                                    $cat_map = [];
                                                                                    foreach ($cat_data as $cat) {
                                                                                        $cat_map[$cat->id] = $cat->category_name;
                                                                                    }
                                                                                    if (!empty($commentData->cat_id)) {
                                                                                        $category_id = explode(',', $commentData->cat_id);
                                                                                        $category_name = array_map(function($id) use ($cat_map) {
                                                                                            return isset($cat_map[trim($id)]) ? $cat_map[trim($id)] : null;
                                                                                        }, $category_id);
                                                                                        $category_name = array_filter($category_name);
                                                                                        $category_name_display = implode(', ', $category_name);
                                                                                        echo "<b>".$category_name_display."</b>";
                                                                                    }
                                                                                    ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <p style="width: 60px;height: 20px;display: inline-block;float: right;position: relative;top: -55px;bottom: 0;font-weight: bold;">Pinned</p>
                                                                            <div class="comments-text ml-65" style="display: inline-block;margin-top: 0px;margin-left: 35px;">
                                                                                <p><?= $commentData->comment ?></p>
                                                                                <div class="comments-replay">
                                                                                    <a href="javascript:void(0)" class="btn btn-info" onclick="replyComment(<?= $commentData->id ?>)">Reply</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                <?php } ?>
                                                                </ul>
                                                                <?php } ?>
                                                                <?php $commentCount = $this->db->query("SELECT count(id) as count FROM community_comment WHERE community_id = '" . $comment_id . "'")->row(); ?>
                                                                <h3><?= $commentCount->count; ?> Comments</h3>
                                                                <ul style="padding: 0px !important;">
                                                                <?php
                                                                $commentList = $this->db->query("SELECT * FROM community_comment WHERE community_id = '" . @$comment_id . "' ORDER BY id DESC")->result_array();
                                                                if (!empty($commentList)) {
                                                                    foreach ($commentList as $value) {
                                                                    $userData = $this->db->query("SELECT * FROM users WHERE id = '" . $value['user_id'] . "'")->row(); ?>
                                                                    <li>
                                                                        <div class="comments-box grey-bg" style="padding: 15px !important;">
                                                                            <div class="comments-info d-flex">
                                                                                <div class="comments-avatar mr-10">
                                                                                <?php if (!empty($userData->image)) { ?>
                                                                                    <img src="<?= base_url() ?>uploads/profile_pictures/<?= $userData->image ?>" />
                                                                                <?php } else { ?>
                                                                                    <img src="<?= base_url() ?>images/no-user.png" />
                                                                                <?php } ?>
                                                                                </div>
                                                                                <div class="avatar-name" style="margin-left: 10px;">
                                                                                    <h3 style="margin-top: 0px; font-weight: bold; margin-bottom: 0; font-size: 16px;"><?= ucwords($value['full_name']) ?></h3>
                                                                                    <span class="post-meta" style="font-size: 12px;"><?= date('M j, Y', strtotime($value['created_at'])) ?> in
                                                                                    <?php
                                                                                    $cat_data = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result();
                                                                                    $cat_map = [];
                                                                                    foreach ($cat_data as $cat) {
                                                                                        $cat_map[$cat->id] = $cat->category_name;
                                                                                    }
                                                                                    if (!empty($value['cat_id'])) {
                                                                                        $category_id = explode(',', $value['cat_id']);
                                                                                        $category_name = array_map(function($id) use ($cat_map) {
                                                                                            return isset($cat_map[trim($id)]) ? $cat_map[trim($id)] : null;
                                                                                        }, $category_id);
                                                                                        $category_name = array_filter($category_name);
                                                                                        $category_name_display = implode(', ', $category_name);
                                                                                        echo "<b>".$category_name_display."</b>";
                                                                                    }
                                                                                    ?>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                            <?php
                                                                            $checkPinedStatus = $this->db->query("SELECT * FROM pin_comment WHERE comment_id = '".$value['id']."'")->row();
                                                                            if(@$checkPinedStatus->pinned == '1'){ ?>
                                                                            <img src="<?= base_url('assets/img/push-unpin-icon.png')?>" style="width: 20px;height: 20px;display: inline-block;float: right;position: relative;top: -55px;bottom: 0;" onclick="pinComment('<?= $value['id'] ?>', '0')">
                                                                            <?php } else { ?>
                                                                            <img src="<?= base_url('assets/img/push-pin-icon.png')?>" style="width: 20px;height: 20px;display: inline-block;float: right;position: relative;top: -55px;bottom: 0;" onclick="pinComment('<?= $value['id'] ?>', '1')">
                                                                            <?php } ?>

                                                                            <div class="comments-text ml-65" style="display: inline-block; margin-top: 0; margin-left: 35px;">
                                                                                <p style="margin-bottom: 0 !important;"><?= $value['comment'] ?></p>
                                                                                <div class="comments-replay" style="margin-top: 2px !important;">
                                                                                    <a href="javascript:void(0)" class="btn btn-info" onclick="replyComment(<?= $value['id'] ?>)">Reply</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <?php
                                                                    $commentRply = $this->db->query("SELECT * FROM community_comment_rply WHERE community_id = '" . $comment_id . "' AND comment_id = '" . $value['id'] . "'")->result_array();
                                                                    if (!empty($commentRply)) {
                                                                    foreach ($commentRply as $data) {
                                                                    $userData1 = $this->db->query("SELECT * FROM users WHERE id = '" . $data['user_id'] . "'")->row(); ?>
                                                                    <li class="children">
                                                                        <div class="comments-box grey-bg">
                                                                            <div class="comments-info d-flex">
                                                                                <div class="comments-avatar mr-10">
                                                                                    <?php if (!empty($userData1->image)) { ?>
                                                                                    <img src="<?= base_url() ?>uploads/profile_pictures/<?= $userData1->image ?>" />
                                                                                    <?php } else { ?>
                                                                                    <img src="<?= base_url() ?>images/no-user.png" />
                                                                                    <?php } ?>
                                                                                </div>
                                                                                <div class="avatar-name" style="margin-left: 10px;">
                                                                                <h3 style="margin-top: 0px; font-weight: bold; margin-bottom: 0; font-size: 16px;"><?= ucwords($data['full_name']) ?></h3>
                                                                                    <span class="post-meta" style="font-size: 12px;"><?= date('M j, Y', strtotime($data['created_at'])) ?></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="comments-text ml-65" style="display: inline-block; margin-top: 0; margin-left: 35px;">
                                                                                <p style="margin-bottom: 0 !important;"><?= $data['comment'] ?></p>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                    <?php } } } } else { ?>
                                                                    <li>No comment yet</li>
                                                                    <?php } ?>
                                                                </ul>
                                                                <input type="hidden" name="comm_id" id="comm_id" value="<?= @$comment_id ?>">
                                                            </div>
                                                        </div>
                                                        <?php
                                                        if (!empty($this->session->userdata('user_id'))) {
                                                        $getUser = $this->db->query("SELECT * FROM users WHERE id = '" . $this->session->userdata('user_id') . "'")->row();
                                                        ?>
                                                        <div class="blog__comment" style="padding: 20px;">
                                                            <h3>Write a Comment</h3>
                                                            <form action="#" id="contact-form">
                                                                <div class="row">
                                                                    <div class="col-sm-6 col-sm-6 col-lg-6">
                                                                        <div class="blog__comment-input">
                                                                            <input type="text" placeholder="Your Name" name="full_name" id="full_name" value="<?= $getUser->full_name ?>" required readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-sm-6 col-lg-6">
                                                                        <div class="blog__comment-input">
                                                                            <input type="email" placeholder="Your Email" name="email" id="email" value="<?= $getUser->email ?>" required readonly>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-sm-6 col-lg-6">
                                                                        <div class="blog__comment-input">
                                                                            <select name="cat_id[]" class="form-control" id="cat_id" multiple>
                                                                                <option value="">Select option</option>
                                                                                <?php
                                                                                $community_cat = $this->db->query("SELECT * FROM community_cat WHERE status = '1' AND is_delete = '1'")->result_array();
                                                                                foreach($community_cat as $category) {?>
                                                                                    <option value="<?php echo $category['id']; ?>"
                                                                                    <?php if(!empty($community->cat_id)){
                                                                                        $comcat = explode(", ", $community->cat_id);
                                                                                        for($i=0; $i<count($comcat); $i++) {
                                                                                            if($comcat[$i] == $category['id']){
                                                                                                echo "selected";
                                                                                            }
                                                                                        }
                                                                                    } ?>><?php echo $category['category_name'];?></option>
                                                                                <?php } ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6 col-sm-6 col-lg-6">
                                                                        <div class="blog__comment-input">
                                                                            <input type="text" placeholder="Website" name="website" id="website" value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="blog__comment-input">
                                                                            <textarea placeholder="Enter your comment ..." name="comment" id="comment"></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-12">
                                                                        <div class="blog__comment-btn">
                                                                            <button type="button" class="e-btn" onclick="postComment()">Post Comment</button>
                                                                            <input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id') ?>">
                                                                            <input type="hidden" name="community_id" id="community_id" value="<?= @$comment_id ?>">
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
<style>
.comments-box {
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    padding: 15px;
    padding-right: 40px;
    padding-top: 25px;
}
.grey-bg {
    background: #f3f4f8;
}
.d-flex {
    display: flex !important;
}
.mr-20 {
    margin-right: 20px;
}
.comments-avatar img {
    width: 25px;
    height: 25px;
    -webkit-border-radius: 50%;
    -moz-border-radius: 50%;
    border-radius: 50%;
}
.ml-65 {
    margin-left: 65px;
}
.comments-text p {
    font-size: 16px;
    color: #53545b;
    margin-bottom: 15px;
}
.comments-replay {
    margin-top: 10px;
}
.comments-replay a {
    display: inline-block;
    color: #2b4eff;
    background: rgba(43, 78, 255, 0.1);
    height: 20px;
    line-height: 22px;
    padding: 0 8px;
    font-weight: 500;
    font-size: 14px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
}
.latest-comments ul li.children {
    margin-left: 100px;
}
.latest-comments ul li {
    margin-bottom: 10px;
    list-style: none;
}
.blog__comment h3 {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 20px;
}
.row {
    --bs-gutter-x: 1.5rem;
    --bs-gutter-y: 0;
    display: flex
;
    flex-wrap: wrap;
    margin-top: calc(var(--bs-gutter-y)* -1);
    margin-right: calc(var(--bs-gutter-x) / -2);
    margin-left: calc(var(--bs-gutter-x) / -2);
}
.blog__comment-input input, .blog__comment-input textarea {
    width: 100%;
    height: 56px;
    line-height: 56px;
    border: 2px solid #f3f4f8;
    background: #f3f4f8;
    color: #0e1133;
    font-size: 15px;
    outline: none;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
    border-radius: 4px;
    margin-bottom: 20px;
    padding: 0 24px;
}
</style>
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<style>
.select2-container--default .select2-selection--single {border: 1px solid #aaa; padding: 6px; height: 34px;}
.select2-container {width: 445px !important;}
.select2-selection__choice{color: #000 !important;}
.select2-selection--multiple {height: 56px !important;}
.blog__comment-input{display: inline-block; width: 100%;}
.select2-container--default{border-radius: 15px;}
.select2-container .select2-search--inline .select2-search__field{margin-top: 0px !important;}
.select2-container--default .select2-selection--multiple{background-color: #f3f4f8 !important; border: none !important;}
.select2-container {width: 510px !important;}
</style>
<script>
$('#cat_id').select2({
    //tags: true,
    tokenSeparators: [','],
    placeholder: "Select or Type Community Comment Category",
});
</script>
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
    var cat_id = $('#cat_id').val();
    $.ajax({
        url: "<?= base_url() ?>home/postComment",
        type: "POST",
        data: { user_id: user_id, community_id: community_id, comment_id: comment_id, full_name: full_name, email: email, website: website, comment: comment, cat_id: cat_id},
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

function pinComment(id, status) {
    var user_id = $('#user_id').val();
    var comm_id = $('#comm_id').val();
    var comment_id = id;
    var is_pined = status;
    $.ajax({
        url: "<?= base_url() ?>home/pinComment",
        type: "POST",
        data: {user_id: user_id, comm_id: comm_id, comment_id: comment_id, is_pined: is_pined},
        success: function (data) {
            //console.log(data);
            $('.success_msg').text(data);
            $('#contact-form')[0].reset();
            location.reload();
            // setTimeout(() => {
            //     location.reload();
            // }, 1000);
        }
    })
}

function getCatwisecommentData(id){
    cat_id = id;
    var comm_id = $('#comm_id').val();
    $.ajax({
        url: "<?= base_url('supercontrol/community/getCatwisecommentData') ?>",
        type: "POST",
        data: {cat_id: cat_id, comm_id: comm_id},
        success: function(response){
            console.log(response);
            $('#latest-comments').html(response);
        }
    })
}
</script>