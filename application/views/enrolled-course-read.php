<?php
$user_id = $this->session->userdata('user_id');
$userDetails = $this->Commonmodel->fetch_row('users', array('id' => $user_id));
//print_r($userDetails); die();
$completedCourse = 0;
$courseArray = array();

if (!empty($enrolments)) {
    foreach ($enrolments as $key => $value) {
        $totalModuleSql = "SELECT * FROM `course_modules` WHERE `course_id` = '" . @$value->course_id . "'";
        $totalmodule = $this->db->query($totalModuleSql)->num_rows();
        $moduleData = $this->db->query($totalModuleSql)->result();
        $moduleArray = array();
        if (!empty($moduleData)) {
            foreach ($moduleData as $keyn => $item) {
                $totalMaterialSql = "SELECT * FROM `course_materials` WHERE `course_id` = '" . @$value->course_id . "' AND `module` = '" . @$item->id . "'";
                $totalmaterial = $this->db->query($totalMaterialSql)->num_rows();
                $getAttemptModuleSql = "SELECT COUNT(*) as attemptModule FROM `course_enrollment_status` where `course_id` = '" . @$value->course_id . "' and `module` = '" . $item->id . "' and `enrollment_id` = '" . @$value->enrollment_id . "'";
                $attemptModuleRow = $this->db->query($getAttemptModuleSql)->row();
                $totalComModule = 0;
                if (@$totalmaterial == @$attemptModuleRow->attemptModule && @$totalmaterial != '0') {
                    $totalComModule++;
                    $moduleArray[] = $item->id;
                }
                // echo "<br> Course Id = ".@$value->course_id." Total Module ".$totalmodule." ModuleId = ".$item->id." Material ".$totalmaterial." attempt = ".@$attemptModuleRow->attemptModule." Completed = ".$totalComModule;
            }
        }
        if (@$totalmodule == count($moduleArray)) {
            $courseArray[] = $value->course_id;

        }
    }
}
$condition = "";
if (!empty($courseArray)) {
    $courseIds = implode("', '", $courseArray);
    $condition = " AND course_id NOT IN('$courseIds')";
}
$getEnrolmentSql = "SELECT COUNT(DISTINCT `enrollment_id`) AS activeCourse FROM `course_enrollment_status` WHERE `user_id` = '" . $user_id . "' $condition";
$active_data = $this->db->query($getEnrolmentSql)->row();
$activeCourse = 0;
if (!empty($active_data)) {
    $activeCourse = $active_data->activeCourse;
}
$data = array(
    'ctn_enrolment' => @$ctn_enrolment,
    'courseArray' => count($courseArray)
);
?>
<main>
    <section class="pt-100 pb-145">
        <div class="container">
            <div class="rbt-dashboard-content-wrapper">
                <div class="rbt-tutor-information">
                    <div class="rbt-tutor-information-left d-flex align-items-center">
                        <div class="thumbnail rbt-avatars size-lg">
                            <?php if (!empty($userDetails->image)) { ?>
                                <img src="<?= base_url() ?>/uploads/profile_pictures/<?= $userDetails->image ?>" alt="">
                            <?php } else { ?>
                                <img src="images/no-user.png" alt="">
                            <?php } ?>
                        </div>
                        <div class="tutor-content">
                            <h5 class="title h4 fw-bold">
                                <?= $userDetails->fname ?>
                            </h5>
                            <ul class="listRbt mt--5">
                                <li><i class="far fa-book-alt"></i>
                                    <?php echo @$ctn_enrolment; ?> Courses Enroled
                                </li>
                                <li><i class="far fa-file-certificate"></i>
                                    <?php echo count($courseArray); ?> Certificate
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php $this->load->view('leftbar_dash'); ?>
                <div class="col-lg-8">
                    <div class="card bg-dark shadow">
                        <div class="card-body p-4">
                            <h2 class="h5 fw-bold text-uppercase"><?php echo @$module->name; ?></h2>
                            <hr>
                            <div class="row g-3">
                                <div class="col-lg-12 col-md-12 col-sm-6 col-12">
                                    <div class="rbt-counterup" style="padding: 10px 20px;">
                                        <div class="card">
                                            <div class="card-body">
                                            <?php
                                            if (!empty($materials)) {
                                                $i = 1;
                                                foreach ($materials as $course_v) {
                                                if (@$course_v->material_type == 'video') {  ?>
                                                <section class="mainsteps">
                                                    <!-- <h3 class="mb-3 badge bg-secondary text-white">Step <?php echo $i; ?></h3> -->
                                                    <h3 class="mb-3 badge bg-secondary text-white">Step <?php echo @$i; ?></h3>
                                                    <div class="row">
                                                        <div class="col-lg-12 mb-3">
                                                            <div class="coursevideo">
                                                                <?php
                                                                if (@$course_v->video_type == 'youtube') {
                                                                if (!empty($course_v->video_url)) {
                                                                    parse_str(parse_url($course_v->video_url, PHP_URL_QUERY), $my_array);
                                                                }
                                                                ?>
                                                                <iframe width="560px" height="315px" src="https://www.youtube.com/embed/<?= @$my_array['v'] ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                                <?php }
                                                                if (@$course_v->video_type == 'video') { ?>
                                                                <video width="560" height="315" controls>
                                                                    <source src="<?php echo base_url('uploads/materials/' . @$course_v->video_file); ?>" type="video/mp4">
                                                                    Your browser does not support the video tag.
                                                                </video>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                                <div class="nextbtnClass" id="nextbtn-<?php echo @$i; ?>">
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div>
                                                            <div class="button btn btn-secondary rounded-pill matcommonPrv materialpr-<?php echo @$i; ?>" id="prev" onclick="getPrevMaterial('<?php echo $i; ?>');">&larr; Previous</div>
                                                        </div>
                                                        <?php if (count($materials) > 1) { ?>
                                                            <div class="button btn btn-primary  rounded-pill matcommon material-<?php echo @$i; ?>" id="next" onclick="getCompletedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>', '<?php echo $i; ?>', '<?php echo count($materials); ?>'); getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>');">Next &rarr;</div>
                                                            <div class="button btn btn-primary  rounded-pill submitbtn" id="submitbtn-<?php echo @$i; ?>" style="display: none;" onclick="getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>'); gotoListingModule('<?php echo @$enrollment_id; ?>');">Submit </div>
                                                        <?php } else { ?>
                                                            <div class="button btn btn-primary  rounded-pill" id="submitbtn" onclick="getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>'); gotoListingModule('<?php echo @$enrollment_id; ?>');">Submit </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <?php } ?>

                                                <?php if (@$course_v->material_type == 'resource') { ?>
                                                <section class="mainsteps">
                                                    <h3 class="mb-3 badge bg-secondary text-white">Step <?php echo @$i; ?></h3>
                                                    <h4>Download Course DOC</h4>
                                                    <p>
                                                        <?php if (!empty(@$course_v->material_description)) {
                                                        echo html_entity_decode(@$course_v->material_description);
                                                        } else {
                                                        echo "&#8212;";
                                                        } ?>
                                                    </p>
                                                    <ul class="course-doclist">
                                                    <?php
                                                    $fileList = $this->db->get_where('course_resources', array('material_id' => $course_v->id))->result();
                                                    if (!empty($fileList)) {
                                                    $k = 1;
                                                    foreach ($fileList as $file) { ?>
                                                        <li>
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <div class="flex-fill">
                                                                    <?php echo $k; ?>. <?php echo @$file->resource_file ?>
                                                                </div>
                                                                <div>
                                                                    <a href="<?php echo base_url('uploads/materials/' . @$file->resource_file) ?>" target="__blank" class="downloadModule"><i class="fa fa-download"></i></a>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php $k++; } } ?>
                                                    </ul>
                                                </section>
                                                <div class="nextbtnClass" id="nextbtn-<?php echo @$i; ?>">
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div>
                                                            <div class="button btn btn-secondary rounded-pill matcommonPrv materialpr-<?php echo @$i; ?>" id="prev" onclick="getPrevMaterial('<?php echo $i; ?>');">&larr; Previous</div>
                                                        </div>
                                                        <?php if (count($materials) > 1) { ?>
                                                            <div class="button btn btn-primary  rounded-pill matcommon material-<?php echo @$i; ?>" id="next" onclick="getCompletedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>', '<?php echo $i; ?>', '<?php echo count($materials); ?>'); getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>');">Next &rarr;</div>
                                                            <div class="button btn btn-primary  rounded-pill submitbtn" id="submitbtn-<?php echo @$i; ?>" style="display: none;" onclick="getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>'); gotoListingModule('<?php echo @$enrollment_id; ?>');">Submit </div>
                                                        <?php } else { ?>
                                                            <div class="button btn btn-primary  rounded-pill" id="submitbtn" onclick="getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>'); gotoListingModule('<?php echo @$enrollment_id; ?>');">Submit </div>
                                                        <?php } ?>

                                                    </div>
                                                </div>
                                                <?php } ?>

                                                <?php if (@$course_v->material_type == 'quiz') { ?>
                                                <section class="mainsteps">
                                                    <h3 class="mb-3 badge bg-secondary text-white">Step <?php echo @$i; ?></h3>
                                                    <div id="quizHTML-<?php echo @$i; ?>">
                                                        <h4 style="color: #000;">Quiz</h4>
                                                        <form name="quiz-form-<?php echo @$i; ?>" id="form-<?php echo @$i; ?>" autocomplete="off" method="post" action="javascript:void(0);">
                                                            <?php $quizList = $this->db->get_where('course_quiz', array('material_id' => $course_v->id))->result();
                                                            if (!empty($quizList)) {
                                                            $c = 1;
                                                            foreach ($quizList as $qs) {
                                                            ?>
                                                            <div class="mb-3">
                                                                <h5 class="mb-2 " style="color: #000;">
                                                                <?php echo $c; ?>. <?= $qs->question ?>
                                                                    <input type="hidden" name="questions-<?php echo @$i; ?>[]" value="<?= $qs->id ?>">
                                                                    <?php if (@$qs->quiz_file && file_exists('./uploads/quizs/' . @$qs->quiz_file)) { ?>
                                                                    <img class="qs_image" data-img="<?= base_url('uploads/quizs/' . @$qs->quiz_file) ?>" data-id="<?php echo $c;   ?>" src="<?= base_url('uploads/quizs/' . @$qs->quiz_file) ?>" style="display: block; width: 100px; max-height: 50px; margin-top: 5px; object-fit: cover; cursor: pointer;" alt="question-img">
                                                                    <div class="intro-section-Custom-Modal">
                                                                        <div class="show_image">
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                </h5>
                                                                <div class="questionbox option">
                                                                    <label style="color: #000;"><input type="radio" name="que-<?php echo @$i; ?>-<?= $qs->id ?>" class="radioBtnClass-<?php echo @$i; ?>-<?= $qs->id ?>" value="ans1"> <?= $qs->ans1 ?></label>
                                                                    <?php if (@$qs->ans1_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans1_file)) { ?>
                                                                    <img class="qs_image" data-img="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans1_file) ?>" src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans1_file) ?>" style="display: block; width: 100px; max-height: 50px; margin-bottom: 5px; object-fit: cover; cursor: pointer;" alt="option-img">
                                                                    <div class="intro-section-Custom-Modal">
                                                                        <div class="show_image">
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="questionbox">
                                                                    <label style="color: #000;"><input type="radio" name="que-<?php echo @$i; ?>-<?= $qs->id ?>" class="radioBtnClass-<?php echo @$i; ?>-<?= $qs->id ?>" value="ans2"> <?= $qs->ans2 ?></label>
                                                                    <?php if (@$qs->ans2_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans2_file)) { ?>
                                                                    <img class="qs_image" data-img="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans2_file) ?>" src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans2_file) ?>" style="display: block; width: 100px; max-height: 50px; margin-bottom: 5px; object-fit: cover; cursor: pointer;" alt="option-img">
                                                                        <div class="intro-section-Custom-Modal">
                                                                            <div class="show_image">
                                                                            </div>
                                                                        </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="questionbox">
                                                                    <label style="color: #000;"><input type="radio" name="que-<?php echo @$i; ?>-<?= $qs->id ?>" class="radioBtnClass-<?php echo @$i; ?>-<?= $qs->id ?>" value="ans3"> <?= $qs->ans3 ?></label>
                                                                    <?php if (@$qs->ans3_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans3_file)) { ?>
                                                                    <img class="qs_image" data-img="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans3_file) ?>" src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans3_file) ?>" style="display: block; width: 100px; max-height: 50px; margin-bottom: 5px; object-fit: cover; cursor: pointer;" alt="option-img">
                                                                    <div class="intro-section-Custom-Modal">
                                                                        <div class="show_image">
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                                <div class="questionbox">
                                                                    <label style="color: #000;"><input type="radio" name="que-<?php echo @$i; ?>-<?= $qs->id ?>" class="radioBtnClass-<?php echo @$i; ?>-<?= $qs->id ?>" value="ans4"> <?= $qs->ans4 ?></label>
                                                                    <?php if (@$qs->ans4_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans4_file)) { ?>
                                                                    <img class="qs_image" data-img="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans4_file) ?>" src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans4_file) ?>" style="display: block; width: 100px; max-height: 50px; margin-bottom: 5px; object-fit: cover; cursor: pointer;" alt="option-img">
                                                                    <div class="intro-section-Custom-Modal">
                                                                        <div class="show_image">
                                                                        </div>
                                                                    </div>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <?php $c++; } } ?>
                                                        </form>
                                                    </div>
                                                    <div id="quizResultHTML-<?php echo @$i; ?>">
                                                        <!-- Ajax Response -->
                                                    </div>
                                                </section>
                                                <div class="nextbtnClass" id="nextbtn-<?php echo @$i; ?>">
                                                    <div class="d-flex justify-content-between mt-3">
                                                        <div>
                                                            <div class="button btn btn-secondary rounded-pill matcommonPrv materialpr-<?php echo @$i; ?>" id="prev" onclick="getPrevMaterial('<?php echo $i; ?>');">&larr; Previous</div>
                                                        </div>
                                                        <?php if (count($materials) > 1) { ?>
                                                        <div class="button btn btn-primary  rounded-pill matcommon material-<?php echo @$i; ?> material-plquiz-<?php echo @$i; ?>" id="play-<?php echo @$i; ?>" onclick="getQuizMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>', '<?php echo $i; ?>', '<?php echo count($materials); ?>'); getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>');">Next &rarr;</div>
                                                        <div style="display: none;" class="button btn btn-primary  rounded-pill matcommon material-<?php echo @$i; ?> material-nxquiz-<?php echo @$i; ?>" id="next" onclick="getCompletedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>', '<?php echo $i; ?>', '<?php echo count($materials); ?>'); getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>');">Next &rarr;</div>
                                                        <div class="button btn btn-primary  rounded-pill submitbtn material-nxtqz2-<?php echo @$i; ?>" id="submitbtn-<?php echo @$i; ?>" style="display: none;" onclick="getQuizMaterialSubmit('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>', '<?php echo $i; ?>', '<?php echo count($materials); ?>'); getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>');">Next </div>
                                                        <div style="display: none;" class="button btn btn-primary  rounded-pill submitbtn material-submitqz2-<?php echo @$i; ?>" id="submitbtn-<?php echo @$i; ?>" style="display: none;" onclick="getQuizMaterialSubmit('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>', '<?php echo $i; ?>', '<?php echo count($materials); ?>'); getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>'); gotoListingModule('<?php echo @$enrollment_id; ?>');">Submit </div>
                                                        <?php } else { ?>
                                                        <div class="button btn btn-primary  rounded-pill material-nxtqz-<?php echo @$i; ?>" id="submitbtn" onclick="getQuizMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>', '<?php echo $i; ?>', '<?php echo count($materials); ?>'); getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>');">Next </div>
                                                        <div style="display: none;" class="button btn btn-primary  rounded-pill material-submitqz-<?php echo @$i; ?>" id="submitbtn" onclick="getQuizMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>', '<?php echo $i; ?>', '<?php echo count($materials); ?>'); getSavedMaterial('<?php echo @$enrollment_id; ?>', '<?php echo @$course_v->id; ?>'); gotoListingModule('<?php echo @$enrollment_id; ?>');">Submit </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <?php } $i++; } } else { ?>
                                                <div style="text-align: center; color:#ff0000;">No material available!</div>
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
    </section>
</main>
<style>
.cstm_crs_cls *{color: #fff; text-align: justify; font-size: 13px; line-height: 16px;}
.ansbox .badge{background: #7384e9 !important;}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    var base_color = "rgb(230,230,230)";
    var active_color = "#0089ff";
    var child = 1;
    var length = $(".mainsteps").length - 1;
    var m_id = $("#m_id").val();
    $("#prev").addClass("disabled");
    $("#submit").addClass("disabled");
    $(".mainsteps").not(".mainsteps:nth-of-type(1)").hide();
    $(".mainsteps").not(".mainsteps:nth-of-type(1)").css('transform', 'translateX(100px)');
    var svgWidth = length * 200 + 24;
    $("#svg_wrap").html(
        '<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' +
        svgWidth +
        ' 24" xml:space="preserve"></svg>'
    );
    function makeSVG(tag, attrs) {
        var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
        for (var k in attrs) el.setAttribute(k, attrs[k]);
        return el;
    }
    if (m_id > 1) {
        for (i = 0; i < length; i++) {
            var positionX = 12 + i * 200;
            var rect = makeSVG("rect", {
                x: positionX,
                y: 9,
                width: 200,
                height: 6
            });
            document.getElementById("svg_form_time").appendChild(rect);
            // <g><rect x="12" y="9" width="200" height="6"></rect></g>'
            var circle = makeSVG("circle", {
                cx: positionX,
                cy: 12,
                r: 12,
                width: positionX,
                height: 6
            });
            document.getElementById("svg_form_time").appendChild(circle);
        }
        if (positionX) {
            positionX = positionX + 200;
        } else {
            positionX = 12;
        }
        var circle = makeSVG("circle", {
            // cx: positionX + 200,
            cx: positionX,
            cy: 12,
            r: 12,
            width: positionX,
            height: 6
        });
        document.getElementById("svg_form_time").appendChild(circle);
    }

    $('#svg_form_time rect').css('fill', base_color);
    $('#svg_form_time circle').css('fill', base_color);
    $("circle:nth-of-type(1)").css("fill", active_color);
    $(".button").click(function() {
        $("#svg_form_time rect").css("fill", active_color);
        $("#svg_form_time circle").css("fill", active_color);
        var id = $(this).attr("id");
        if (id == "next") {
            $("#prev").removeClass("disabled");
            if (child >= length) {
                $(this).addClass("disabled");
                $('#submit').removeClass("disabled");
            }
            if (child <= length) {
                child++;
            }
        } else if (id == "prev") {
            $("#next").removeClass("disabled");
            $('#submit').addClass("disabled");
            if (child <= 2) {
                $(this).addClass("disabled");
            }
            if (child > 1) {
                child--;
            }
        }
        var circle_child = child + 1;
        $("#svg_form_time rect:nth-of-type(n + " + child + ")").css(
            "fill",
            base_color
        );
        $("#svg_form_time circle:nth-of-type(n + " + circle_child + ")").css(
            "fill",
            base_color
        );
        var currentSection = $(".mainsteps:nth-of-type(" + child + ")");
        currentSection.fadeIn();
        currentSection.css('transform', 'translateX(0)');
        currentSection.prevAll('.mainsteps').css('transform', 'translateX(-100px)');
        currentSection.nextAll('.mainsteps').css('transform', 'translateX(100px)');
        $('.mainsteps').not(currentSection).hide();
    });
});

$('.prevbtnClass').hide();
$('.nextbtnClass').hide();
$('.submitbtn').hide();
$('#nextbtn-1').show();

function getCompletedMaterial(enrollment_id, id, key, total) {
    $('.nextbtnClass').hide();
    $('.prevbtnClass').hide();
    $('.submitbtn').hide();
    $('.matcommon').removeClass('disabled');
    $('.matcommonPrv').removeClass('disabled');
    var prev = parseInt(key) - 1;
    var next = parseInt(key) + 1;
    if (key < total) {
        $('#prevbtn-' + next).show();
        $('#nextbtn-' + next).show();
    }
    if (next == total) {
        $('#prevbtn-' + next).show();
        $('#nextbtn-' + next).show();
        $('.material-' + next).hide();
        $('#submitbtn-' + next).show();
    }
}

function getQuizMaterial(enrollment_id, id, key, total) {
    var x = $('#quiz-form-' + key).serializeArray();
    var input = document.getElementsByName('questions-' + key + '[]');
    var optionArray = [];
    for (var i = 0; i < input.length; i++) {
        var qId = input[i].value;
        var optId = 'que-' + key + '-' + qId;
        var ele = document.getElementsByName('que-' + key + '-' + qId);
        const radioButtons = document.querySelectorAll('input[name=' + optId + ']');
        let selectedOptions;
        for (j = 0; j < ele.length; j++) {
            if (ele[j].checked) {
                // alert(" Question" + qId + " Answer: "+ele[j].value);
                optionArray.push({
                    id: qId,
                    choice: ele[j].value
                });
            }
        }

        for (const radioButton of radioButtons) {
            if (radioButton.checked) {
                selectedOptions = radioButton.value;
                break;
            }
        }

        var output = selectedOptions ? selectedOptions : '';
        if (output == '') {
            optionArray.push({
                id: qId,
                choice: ""
            });
        }
    }

    if (typeof optionArray !== 'undefined' && optionArray.length > 0) {
        console.log(optionArray);
        if (enrollment_id != '' && id != '') {
            var baseUrl = "<?= base_url(); ?>";
            $.ajax({
                url: baseUrl + 'users/courseQuizMaterial',
                type: 'POST',
                data: {
                    enrollment_id: enrollment_id,
                    id: id,
                    key: key,
                    page: 'next',
                    optionArray: optionArray
                },
                beforeSend: function() {
                    /*$.blockUI({
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });*/
                    setTimeout($.unblockUI, 2000);
                },
                success: function(data) {
                    // $('#quizHTML-' + key).empty();
                    $('#quizResultHTML-' + key).show();
                    $('#quizResultHTML-' + key).html(data);
                    //$('#quizHTML-' + key).html(data);
                    $('#quizHTML-' + key).hide();
                    $('.material-plquiz-' + key).hide();
                    $('.material-nxquiz-' + key).show();
                    $('.material-nxtqz-' + key).hide();
                    $('.material-submitqz-' + key).show();
                    $('.material-nxtqz2-' + key).hide();
                    $('.material-submitqz2-' + key).hide();
                    $.unblockUI();
                }
            });
        }
    }
}

function getQuizMaterialSubmit(enrollment_id, id, key, total) {
    var x = $('#quiz-form-' + key).serializeArray();
    var input = document.getElementsByName('questions-' + key + '[]');
    var optionArray = [];
    for (var i = 0; i < input.length; i++) {
        var qId = input[i].value;
        var optId = 'que-' + key + '-' + qId;
        var ele = document.getElementsByName('que-' + key + '-' + qId);
        const radioButtons = document.querySelectorAll('input[name=' + optId + ']');
        let selectedOptions;
        for (j = 0; j < ele.length; j++) {
            if (ele[j].checked) {
                // alert(" Question" + qId + " Answer: "+ele[j].value);
                optionArray.push({
                    id: qId,
                    choice: ele[j].value
                });
            }
        }
        for (const radioButton of radioButtons) {
            if (radioButton.checked) {
                selectedOptions = radioButton.value;
                break;
            }
        }
        var output = selectedOptions ? selectedOptions : '';
        if (output == '') {
            optionArray.push({
                id: qId,
                choice: ""
            });
        }
    }

    if (typeof optionArray !== 'undefined' && optionArray.length > 0) {
        console.log(optionArray);
        if (enrollment_id != '' && id != '') {
            var baseUrl = "<?= base_url(); ?>";
            $.ajax({
                url: baseUrl + 'users/courseQuizMaterial',
                type: 'POST',
                data: {
                    enrollment_id: enrollment_id,
                    id: id,
                    key: key,
                    page: 'end',
                    optionArray: optionArray
                },
                beforeSend: function() {
                    /*$.blockUI({
                        css: {
                            border: 'none',
                            padding: '15px',
                            backgroundColor: '#000',
                            '-webkit-border-radius': '10px',
                            '-moz-border-radius': '10px',
                            opacity: .5,
                            color: '#fff'
                        }
                    });*/
                    setTimeout($.unblockUI, 2000);
                },
                success: function(data) {
                    // $('#quizHTML-' + key).empty();
                    $('#quizResultHTML-' + key).show();
                    $('#quizResultHTML-' + key).html(data);
                    //$('#quizHTML-' + key).html(data);
                    $('#quizHTML-' + key).hide();
                    $('.material-plquiz-' + key).hide();
                    $('.material-nxquiz-' + key).hide();
                    $('.material-nxtqz2-' + key).hide();
                    $('.material-submitqz2-' + key).show();
                    $.unblockUI();
                }
            });
        }
    }
}

function getQuizTryAgain(enrollment_id, id, key) {
    $('#quizResultHTML-' + key).empty();
    $('#quizResultHTML-' + key).hide();
    $('#quizHTML-' + key).show();
    $('.material-plquiz-' + key).show();
    $('.material-nxquiz-' + key).hide();
    $('.material-nxtqz-' + key).show();
    $('.material-submitqz-' + key).hide();
}

function getSavedMaterial(enrollment_id, id) {
    if (enrollment_id != '' && id != '') {
        var baseUrl = "<?= base_url(); ?>";
        $.ajax({
            url: baseUrl + 'users/completedMaterial',
            type: 'POST',
            data: {
                enrollment_id: enrollment_id,
                id: id
            },
            beforeSend: function() {
                /*$.blockUI({
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }
                });*/
                setTimeout($.unblockUI, 2000);
            },
            success: function(data) {
                // $('#quizHTML-' + key).html(data);
                //$.unblockUI();
            }
        });
    }
}

function gotoListingModule(id) {
    if (gotoListingModule) {
        window.location.href = "<?= base_url(); ?>" + 'users/courseModule/' + id;
    }
}

function getPrevMaterial(key) {
    $('.nextbtnClass').hide();
    $('.prevbtnClass').hide();
    $('.submitbtn').hide();
    var prev = parseInt(key) - 1;
    if (key > 1) {
        $('#prevbtn-' + prev).show();
        $('#nextbtn-' + prev).show();
        $('.materialpr-' + prev).show();
        $('.matcommon').removeClass('disabled');
        $('.matcommonPrv').removeClass('disabled');
    }

    if (prev == 1) {
        $('.materialpr-' + prev).hide();
        $('#nextbtn-' + prev).show();
        $('#submitbtn-' + prev).hide();
    }
}

$('#reviewButton').click(function() {
    var course_id = $('#course_id').val();
    var message = $('#review_msg').val().trim();
    var ratingValue = $("input[name='rating']:checked").val();
    if (typeof ratingValue == 'undefined' && message == "") {
        $('#error').show();
        $('#error').text("Rating/Message is not empty!");
    } else if (course_id != '') {
        var baseUrl = "<?= base_url(); ?>";
        $.ajax({
            url: baseUrl + 'home/reviewSave',
            type: 'POST',
            data: {
                course_id: course_id,
                rating: ratingValue,
                message: message
            },
            beforeSend: function() {
                $('#error').hide();
                $("#review-txt").hide();
                $("#review-txt").text("");
                /*$.blockUI({
                    css: {
                        border: 'none',
                        padding: '15px',
                        backgroundColor: '#000',
                        '-webkit-border-radius': '10px',
                        '-moz-border-radius': '10px',
                        opacity: .5,
                        color: '#fff'
                    }
                });*/
                setTimeout($.unblockUI, 2000);
            },
            success: function(revdata) {
                if (revdata == "0") {
                    $('#error').show();
                    $('#error').text("Sorry! Not allowed to posting again!");

                } else {
                    $("#review-txt").show();
                    $("#review-txt").text("Your review is posted successfully!");
                    $('#review_msg').val("");
                    $('#rvCtn').text(revdata);
                    getReviews(course_id);
                }
                //$.unblockUI();
            }
        });
    }
});

function getReviews(course_id) {
    var baseUrl = "<?= base_url(); ?>";
    if (course_id) {
        $.ajax({
            url: baseUrl + 'home/getAllReviews',
            type: 'POST',
            data: {
                course_id: course_id,
            },
            beforeSend: function() {},
            success: function(revdata) {
                $('#reviewHTML').html(revdata);
            }
        });
    }
}

$(".qs_image").click(function() {
    var id = $(this).attr("data-id");
    var img = $(this).attr("data-img");
    $(".show_image").html("<img src=" + img + " style='display: block;  margin-top: 5px; object-fit: cover; cursor: pointer;' alt='question-img'><a class='close-modal'>Close (x)</a>");
    $(".intro-section-Custom-Modal").addClass("modalshow");
    $(".close-modal").click(function() {
        $(".intro-section-Custom-Modal").removeClass("modalshow");
    });
});
</script>