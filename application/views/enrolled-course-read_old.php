<div class="main-content">
    <!-- Breadcrumbs Start -->
    <div class="rs-breadcrumbs breadcrumbs-overlay">
        <div class="breadcrumbs-img">
            <img src="<?= base_url() ?>user_assets/images/breadcrumbs/2.jpg" alt="Breadcrumbs Image">
        </div>
        <div class="breadcrumbs-text white-color">
            <h1 class="page-title">
                <?php if (@$courses->title) {
                    echo @$courses->title;
                } else {
                    echo "&#8212;";
                } ?>
            </h1>
            <ul>
                <li>
                    <a class="active" href="<?= base_url('student-dashboard') ?>">Home</a>
                </li>
                <li>
                    <a class="" href="<?= base_url('users/courseModule/' . @$enrollment_id) ?>">Module List</a>
                </li>
                <li>
                    <?php if (@$courses->title) {
                        echo @$courses->title;
                    } else {
                        echo "&#8212;";
                    } ?>
                </li>
            </ul>
        </div>
    </div>
</div>

<section class="intro-section py-5 loaded">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 mb-3">
                <div class="sidebar shadow-sm">
                    <?php include("usr-menu.php"); ?>
                </div>
            </div>
            <div class="col-lg-9">
                <div>
                    <div>
                        <div class="row justify-content-between align-items-center">
                            <div class="col-lg-6">
                                <h3> <?php echo @$module->name; ?></h3>
                            </div>
                            <div class="col-lg-6">
                                <?php
                                if (count($materials) > 1) { ?>
                                    <div id="svg_wrap"></div>
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" id="m_id" value="<?php echo count($materials); ?>" />
                        <div class="card">
                            <div class="card-body">

                                <?php
                                if (!empty($materials)) {
                                    $i = 1;
                                    foreach ($materials as $course_v) {
                                ?>

                                        <?php if (@$course_v->material_type == 'video') {  ?>
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
                                                            if (@$course_v->video_type == 'video') {
                                                            ?>
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
                                                <!-- <h3 class="mb-3 badge bg-secondary text-white">Step 4</h3> -->
                                                <h3 class="mb-3 badge bg-secondary text-white">Step <?php echo @$i; ?></h3>
                                                <h4>Download Course DOC</h4>
                                                <p><?php if (!empty(@$course_v->material_description)) {
                                                        echo html_entity_decode(@$course_v->material_description);
                                                    } else {
                                                        echo "&#8212;";
                                                    } ?></p>
                                                <ul class="course-doclist">
                                                    <?php
                                                    $fileList = $this->db->get_where('course_resources', array('material_id' => $course_v->id))->result();

                                                    if (!empty($fileList)) {
                                                        $k = 1;
                                                        foreach ($fileList as $file) {
                                                    ?>
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
                                                    <?php $k++;
                                                        }
                                                    } ?>
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
                                                <!-- <h3 class="mb-3 badge bg-secondary text-white">Step 5</h3> -->
                                                <h3 class="mb-3 badge bg-secondary text-white">Step <?php echo @$i; ?></h3>

                                                <div id="quizHTML-<?php echo @$i; ?>">
                                                    <h4>Quiz</h4>
                                                    <form name="quiz-form-<?php echo @$i; ?>" id="form-<?php echo @$i; ?>" autocomplete="off" method="post" action="javascript:void(0);">
                                                        <?php
                                                        $quizList = $this->db->get_where('course_quiz', array('material_id' => $course_v->id))->result();

                                                        if (!empty($quizList)) {
                                                            $c = 1;
                                                            foreach ($quizList as $qs) {
                                                        ?>
                                                                <div class="mb-3">
                                                                    <h5 class="mb-2 ">
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
                                                                        <label><input type="radio" name="que-<?php echo @$i; ?>-<?= $qs->id ?>" class="radioBtnClass-<?php echo @$i; ?>-<?= $qs->id ?>" value="ans1"> <?= $qs->ans1 ?></label>
                                                                        <?php if (@$qs->ans1_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans1_file)) { ?>
                                                                            <img class="qs_image" data-img="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans1_file) ?>" src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans1_file) ?>" style="display: block; width: 100px; max-height: 50px; margin-bottom: 5px; object-fit: cover; cursor: pointer;" alt="option-img">

                                                                            <div class="intro-section-Custom-Modal">
                                                                                <div class="show_image">

                                                                                </div>
                                                                            </div>



                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="questionbox">
                                                                        <label><input type="radio" name="que-<?php echo @$i; ?>-<?= $qs->id ?>" class="radioBtnClass-<?php echo @$i; ?>-<?= $qs->id ?>" value="ans2"> <?= $qs->ans2 ?></label>
                                                                        <?php if (@$qs->ans2_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans2_file)) { ?>
                                                                            <img class="qs_image" data-img="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans2_file) ?>" src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans2_file) ?>" style="display: block; width: 100px; max-height: 50px; margin-bottom: 5px; object-fit: cover; cursor: pointer;" alt="option-img">

                                                                            <div class="intro-section-Custom-Modal">
                                                                                <div class="show_image">

                                                                                </div>
                                                                            </div>

                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="questionbox">
                                                                        <label><input type="radio" name="que-<?php echo @$i; ?>-<?= $qs->id ?>" class="radioBtnClass-<?php echo @$i; ?>-<?= $qs->id ?>" value="ans3"> <?= $qs->ans3 ?></label>
                                                                        <?php if (@$qs->ans3_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans3_file)) { ?>
                                                                            <img class="qs_image" data-img="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans3_file) ?>" src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans3_file) ?>" style="display: block; width: 100px; max-height: 50px; margin-bottom: 5px; object-fit: cover; cursor: pointer;" alt="option-img">

                                                                            <div class="intro-section-Custom-Modal">
                                                                                <div class="show_image">

                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="questionbox">
                                                                        <label><input type="radio" name="que-<?php echo @$i; ?>-<?= $qs->id ?>" class="radioBtnClass-<?php echo @$i; ?>-<?= $qs->id ?>" value="ans4"> <?= $qs->ans4 ?></label>
                                                                        <?php if (@$qs->ans4_file && file_exists('./uploads/quizs/answer_files/' . @$qs->ans4_file)) { ?>
                                                                            <img class="qs_image" data-img="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans4_file) ?>" src="<?= base_url('uploads/quizs/answer_files/' . @$qs->ans4_file) ?>" style="display: block; width: 100px; max-height: 50px; margin-bottom: 5px; object-fit: cover; cursor: pointer;" alt="option-img">
                                                                            <div class="intro-section-Custom-Modal">
                                                                                <div class="show_image">

                                                                                </div>
                                                                            </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                </div>
                                                        <?php $c++;
                                                            }
                                                        } ?>
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
                                        <?php } ?>

                                    <?php $i++;
                                    }
                                } else { ?>
                                    <div style="text-align: center; color:#ff0000;">No material available!</div>
                                <?php } ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>