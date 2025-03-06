<!-- Main content -->
<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Community Lists</h3>
                    <a href="<?= admin_url('community/add_community') ?>" class="pull-right btn btn-primary">Add</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered" id="communityList">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Course Title</th>
                                <th>Community Title</th>
                                <th>Description</th>
                                <th>Community Category</th>
                                <th>Posted By</th>
                                <th>Event</th>
                                <th>Status</th>
                                <th style="width: 40px">Action</th>
                            </tr>
                        </thead>
                        <?php
                        if (is_array($community) && count($community) > 0) {
                        $i = 1;
                        foreach ($community as $community_v) {
                            $string = strip_tags($community_v->description);
                            if (strlen($string) > 500) {
                                $stringCut = substr($string, 0, 900);
                                $endPoint = strrpos($stringCut, ' ');
                                $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                $string .= '    ....';
                            }
                            $cat_data = $this->db->query("SELECT * FROM community_cat")->result();
                            $cat_map = [];
                            foreach ($cat_data as $cat) {
                                $cat_map[$cat->id] = $cat->category_name;
                            }
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <?php
                                if(!empty($community_v->course_id)) {
                                    $course_details = $this->db->query("SELECT * FROM courses WHERE id = '".$community_v->course_id."'")->row();
                                    echo $course_details->title;
                                }
                                ?>
                            </td>
                            <td><?= $community_v->title ?></td>
                            <td><?= $string?></td>
                            <td>
                                <?php
                                if (!empty($community_v->cat_id)) {
                                    $category_id = explode(',', $community_v->cat_id);
                                    $category_name = array_map(function($id) use ($cat_map) {
                                        return isset($cat_map[trim($id)]) ? $cat_map[trim($id)] : null;
                                    }, $category_id);
                                    $category_name = array_filter($category_name);
                                    echo $category_name_display = implode(', ', $category_name);
                                } ?>
                            </td>
                            <td>
                                <?php
                                if(!empty($community_v->uploaded_by)){
                                    $userdetails = $this->db->query("SELECT * FROM users WHERE id = '".$community_v->uploaded_by."'")->row();
                                    echo $userdetails->full_name;
                                } else {
                                    echo "Admin";
                                }
                                ?>
                            </td>
                            <td>
                                <a href="<?= admin_url('community/add_event/'.$community_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-plus"></span> Add </a>
                                <a href="<?= admin_url('community/event_list/'.$community_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-eye"></span> View </a>
                            </td>
                            <td>
                                <?php if ($community_v->status == 1) { ?>
                                <a href="<?= admin_url('community/deactivate/' . $community_v->id) ?>"><span class="badge bg-green">Active</span></a>
                                <?php } else { ?>
                                <a href="<?= admin_url('community/activate/' . $community_v->id) ?>"><span class="badge bg-red">Inactive</span></a>
                                <?php } ?>
                            </td>
                            <td>
                                <div class="action-button">
                                    <a href="<?= admin_url('community/add_community/' . $community_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <a href="<?= admin_url('community/delete/' . $community_v->id) ?>" class="btn btn-xs btn-danger delete"><span class="fa fa-trash"></span></a>
                                </div>
                                <div class="action-button" style="width: 100%;">
                                    <a href="<?= admin_url('community/view_community_comment/' . $community_v->id) ?>" class="btn btn-xs btn-info" style="width: 100%;"><span class="fa fa-eye"></span> View Comments</a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } } ?>
                    </table>
                </div>
                <div class="box-footer clearfix"><?= $paginate ?></div>
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
    width: 50px;
    height: 50px;
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
}
</style>
<script>
    function viewCommentData(community_id) {
        var id = community_id;
        $.ajax({
            type: "POST",
            url: "<?= admin_url('community/get_comment_data') ?>",
            data: {comm_id: id},
            success: function(data) {
                $('#comment_data').html(data);
            }
        })
    }
</script>