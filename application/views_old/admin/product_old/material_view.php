<style>
.action-button {float: left;}
.table>thead>tr>th {vertical-align: baseline;}
.table>tbody>tr>td {vertical-align: middle;}
</style>
<section class="content-header">
    <h1><?= $title ?></h1>
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?= admin_url('course/course_list') ?>"> Course List</a></li>
        <li class="active"><?= $title ?></li>
    </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                    <!-- <h3 class="box-title">Course Category Lists</h3> -->
                    <a style="float:right;" href="<?= admin_url('course/add_materials/' . $course_id) ?>" class="btn btn-xs btn-info"><span class="fa fa-plus"></span> Add Material</a>
                </div>
                <div class="box-body">
                    <table class="table table-bordered2 table-striped">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Module</th>
                                <th>Type</th>
                                <th width="200px">Video</th>
                                <th width="300px">Resource</th>
                                <th width="500px">Quiz</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        if (is_array($materials) && count($materials) > 0) {
                        $i = 1;
                        foreach ($materials as $course_v) {
                        $crsnm = $this->db->get_where('course_modules', array('id' => $course_v->module))->row();
                        ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>
                                <?php if (!empty($crsnm->name)) {
                                    echo $crsnm->name;
                                } else {
                                    echo "&#8212;";
                                } ?>
                            </td>
                            <td>
                                <?php if (!empty($course_v->material_type)) {
                                    echo $course_v->material_type;
                                } else {
                                    echo "&#8212;";
                                } ?>
                            </td>
                            <td>
                                <?php
                                if (@$course_v->material_type == 'video') {
                                if (@$course_v->video_type == 'youtube') {
                                if (!empty($course_v->video_url)) {
                                parse_str(parse_url($course_v->video_url, PHP_URL_QUERY), $my_array);
                                }
                                ?>
                                <iframe width="200px" height="120px" src="https://www.youtube.com/embed/<?= @$my_array['v'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                <?php } else { ?>
                                <video width="200" height="120" controls>
                                    <source src="<?php echo base_url('uploads/materials/' . @$course_v->video_file); ?>" type="video/mp4"> Your browser does not support the video tag. </video>
                                <?php }
                                } else {
                                    echo "&#8212;";
                                } ?>
                            </td>
                            <td>
                                <div class="truncate_desc">
                                <?php
                                $fileList = $this->db->get_where('course_resources', array('material_id' => $course_v->id))->result();
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
                                <?php if (!empty(@$course_v->material_description)) {
                                    echo html_entity_decode(@$course_v->material_description);
                                } else {
                                    echo "&#8212;";
                                } ?>
                                </div>
                            </td>
                            <td>
                            <?php if (@$course_v->material_type == 'quiz') {
                            $quizList = $this->db->get_where('course_quiz', array('material_id' => $course_v->id))->result();
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
                                    <a href="<?= admin_url('course/update_material/' . $this->uri->segment(4) . '/' . $course_v->id) ?>" class="btn btn-xs btn-info"><span class="fa fa-pencil"></span></a>
                                    <a href="javascript:void(0);" onclick="deleteMaterial('<?= @$course_v->id ?>', '<?= @$course_id ?>')" class="btn btn-xs btn-danger"><span class="fa fa-trash"></span></a>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; } } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
function deleteMaterial(id, course_id) {
    swal({
        title: 'Are You sure want to delete this file?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#36A1EA',
        cancelButtonColor: '#e50914',
        confirmButtonText: 'Yes',
        cancelButtonText: 'No',
        closeOnConfirm: true,
        closeOnCancel: true
    }, function (isConfirm) {
        if (isConfirm) {
            window.location.href = '<?= admin_url('course/delete_material/') ?>' + id + '/' + course_id
        }
    });
}
</script>