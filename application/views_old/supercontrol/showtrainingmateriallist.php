<style>
#sample_1_filter {padding: 8px;float: right;}
#sample_1_length {padding: 8px;}
#sample_1_info {padding: 8px;}
#sample_1_paginate {float: right;padding: 8px;}
.dataTables_info {padding: 7px;}
</style>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <?php $this->load->view('supercontrol/leftbar'); ?>
        </div>
    </div>.
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i></li>
                    <li> <span>supercontrol Panel</span> <i class="fa fa-circle"></i> </li>
                    <li> <span>Show Training Material List </span> </li>
                </ul>
            </div>
            <?php if (@$success_msg) {
                echo @$success_msg;
            } ?>
            <?php if (@$message) {
                echo @$message;
            } ?>
            <?php if (@$msg) {
                echo @$msg;
            } ?>
            <?php if (@$msg1) {
                echo @$msg1;
            } ?>
            <?php if ($this->session->flashdata('success') != '') { ?>
            <div class="alert alert-success text-center">
                <?php echo $this->session->flashdata('success'); ?>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Show Training Material List </div>
                                        <div class="tools"> 
                                            <a href="javascript:;" class="collapse"> </a> 
                                            <a href="javascript:;" class="reload"> </a> 
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <?php
                                    $CurPageURL = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];  
                                    $end = end(explode('/', $CurPageURL));
                                    ?>
                                    <div class="portlet-body form">
                                        <!-- <button class="btn btn-warning btn-sm pull-right" id="del_all" style="padding:5px; margin:8px;">
                                            <a style="float:right;" href="<?= base_url()?>'course/add_materials/'.<?= $course_id?>" class="btn btn-xs btn-info"><span class="fa fa-plus"></span> Add Material</a>
                                        </button> -->
                                        <div style="text-align: end;margin: 10px;display: inline-block;width: 98%;">
                                            <a class="btn green btn-sm btn-outline uppercase" href="<?php echo base_url(); ?>supercontrol/course/add_course_trainingmaterial_view/<?php echo $end; ?>"><i class="fa fa-plus" aria-hidden="true"></i> Add Material</a>
                                        </div>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                            <div id="mydiv">
                                                <thead>
                                                    <tr>
                                                        <th><input id="selectall" type="checkbox"></th>
                                                        <th>Sl No</th>
                                                        <th>Module</th>
                                                        <th>Type</th>
                                                        <th>Video</th>
                                                        <th>Resource</th>
                                                        <th>Quiz</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php if (is_array($syllabuslist)): ?>
                                                <?php $ctn = 1;
                                                foreach ($syllabuslist as $i) { 
                                                    $crsnm = $this->db->get_where('course_modules', array('id' => $i->module))->row();?>
                                                    <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                                        <td><input name="checkbox[]" class="checkbox1" type="checkbox" value="<?php echo $i->id; ?>"></td>
                                                        <td><?php echo $ctn; ?></td>
                                                        <td>
                                                            <?php if (!empty($crsnm->name)) {
                                                                echo $crsnm->name;
                                                            } else {
                                                                echo "&#8212;";
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php if (!empty($i->material_type)) {
                                                                echo $i->material_type;
                                                            } else {
                                                                echo "&#8212;";
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if (@$i->material_type == 'video') {
                                                            if (@$i->video_type == 'youtube') {
                                                            if (!empty($i->video_url)) {
                                                            parse_str(parse_url($i->video_url, PHP_URL_QUERY), $my_array);
                                                            }
                                                            ?>
                                                            <iframe width="200px" height="120px" src="https://www.youtube.com/embed/<?= @$my_array['v'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                            <?php } else { ?>
                                                            <video width="200" height="120" controls>
                                                                <source src="<?php echo base_url('uploads/materials/' . @$i->video_file); ?>" type="video/mp4"> Your browser does not support the video tag. </video>
                                                            <?php }
                                                            } else {
                                                                echo "&#8212;";
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <div class="truncate_desc">
                                                            <?php
                                                            $fileList = $this->db->get_where('course_resources', array('material_id' => $i->id))->result();
                                                            if (!empty($fileList)) {
                                                            $k = 1;
                                                            foreach ($fileList as $file) { ?>
                                                                <div>
                                                                    <?= $k ?>. 
                                                                    <a href="<?php echo base_url('uploads/materials/' . @$file->resource_file) ?>" target="__blank" title="Download"> <?php echo @$file->resource_file ?></a>
                                                                </div>
                                                                <?php $k++;
                                                            } } ?>
                                                            </div>
                                                            <div class="truncate_desc">
                                                            <?php if (!empty(@$i->material_description)) {
                                                                echo html_entity_decode(@$i->material_description);
                                                            } else {
                                                                echo "&#8212;";
                                                            } ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <?php if (@$i->material_type == 'quiz') {
                                                            $quizList = $this->db->get_where('course_quiz', array('material_id' => $i->id))->result();
                                                            if (!empty($quizList)) {
                                                            foreach ($quizList as $qs) { ?>
                                                                <div style="padding-bottom: 10px;">
                                                                    <b>Question: <?= $qs->question ?> </b>
                                                                    <ul style="margin-bottom:5px;">
                                                                        <li><?= $qs->ans1 ?></li>
                                                                        <li><?= $qs->ans2 ?></li>
                                                                        <li><?= $qs->ans3 ?></li>
                                                                        <li><?= $qs->ans4 ?></li>
                                                                    </ul>
                                                                    <b>Answer:<?= @$qs->correct_answer ?></b>
                                                                </div>
                                                            <?php } }
                                                            } else {
                                                                echo "&#8212;";
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <div class="action-button">
                                                                <a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url() ?>supercontrol/course/edit_trainingmaterial_view/<?= $this->uri->segment(4)?>/<?= $i->id ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                                                <a class="btn red btn-sm btn-outline sbold uppercase" onclick="return confirm('Are you you want to  delete?');" href="<?php echo base_url() ?>supercontrol/course/delete_trainingmaterial/<?= $this->uri->segment(4)?>/<?= $i->id ?>"><span class="fa fa-trash"></span></a>
                                                            </div>
                                                        </td>
                                                        </tr>
                                                    <?php $ctn++; } ?>
                                                    <?php endif; ?>
                                                </tbody>
                                            </div>
                                        </table>
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
    //resetcheckbox();
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
        //return  false;
        //alert ("<?php echo base_url() ?>supercontrol/controllers/press/delete_multiple");
        $.ajax({
            url: '<?php echo base_url() ?>supercontrol/press/delete_multiple',
            type: 'post',
            data: 'ids=' + checkValues
        }).done(function (data) {
            $("#respose").html(data);
            var newurl = '<?php echo base_url() ?>supercontrol/press/show_press';
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
        url: "<?php echo base_url(); ?>supercontrol/press/statuspress",
        data: { stat: stat, id: id }
    });
}
</script>
<?php //$this->load->view ('footer');?>