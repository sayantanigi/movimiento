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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?= $title ?></h3>
                </div>
                <form action="<?= admin_url('course/add_course/' . $course->id) ?>" id="form_validation" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Category <span style="color:red">*</span></label>
                                            <select name="frm[cat_id]" class="form-control">
                                                <option value="">Choose</option>
                                                <?php foreach ($course_cat as $cat) { ?>
                                                <option <?php if (@$course->cat_id == $cat['id']) { echo "selected"; } ?> value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Name <span style="color:red">*</span></label>
                                            <input type="text" name="frm[title]" value="<?= $course->title ?>" class="form-control course_title" id="exampleInputEmail1" placeholder="Enter Course Name">
                                            <p class="course_name_error" style="display:none;"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Heading 1</label>
                                            <textarea name="frm[heading_1]" class="form-control" rows="3"><?= $course->heading_1 ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Heading 2</label>
                                            <textarea name="frm[heading_2]" class="form-control" rows="3"><?= $course->heading_2 ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Description</label>
                                            <textarea name="frm[description]" id="editor1"><?= $course->description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Program Overview</label>
                                            <textarea name="frm[program_overview]" id="editor2"><?= $course->program_overview ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Objectives</label>
                                            <textarea name="frm[objectives]" id="editor3"><?= $course->objectives ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Curriculam</label>
                                            <textarea name="frm[curriculam]" id="editor4"><?= $course->curriculam ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Career Paths</label>
                                            <textarea name="frm[career_paths]" id="editor5"><?= $course->career_paths ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Duration</label>
                                            <input type="text" name="frm[duration]" value="<?= $course->duration ?>" class="form-control" id="exampleInputEmaila1" placeholder="Enter Course Duration">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Fees <span style="color:red">*</span></label>
                                            <select class="form-control" name="frm[course_fees]" id="course_fees" required>
                                                <option value="">Choose</option>
                                                <option value="free" <?php if ($course->course_fees == 'free') { echo "selected"; } ?>>Free</option>
                                                <option value="paid" <?php if ($course->course_fees == 'paid') { echo "selected"; } ?>>Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="courseTypefield">
                                    <div class="col-sm-10">
                                        <div class="<?php if(!empty($course->price_key)) { echo "col-sm-3"; } else { echo "col-sm-4"; } ?>">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Payment Type <span style="color:red">*</span></label>
                                                <select class="form-control" name="frm[payment_type]" id="payment_type" required>
                                                    <option value="">Choose</option>
                                                    <option value="1" <?php if ($course->payment_type == '1') { echo "selected"; } ?>>One-Time</option>
                                                    <option value="2" <?php if ($course->payment_type == '2') { echo "selected"; } ?>>Recurring</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="<?php if(!empty($course->price_key)) { echo "col-sm-3"; } else { echo "col-sm-4"; } ?>">
                                            <div class="form-group">
                                                <label for="exampleInputPrice1" id="exampleInputRecurring1">Recurring Type</label>
                                                <select class="form-control" name="frm[recurring_type]" id="recurring_type" disabled>
                                                    <option value="">Choose</option>
                                                    <option value="1" <?php if ($course->recurring_type == '1') { echo "selected"; } ?>>Monthly</option>
                                                    <option value="2" <?php if ($course->recurring_type == '2') { echo "selected"; } ?>>Yearly</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="<?php if(!empty($course->price_key)) { echo "col-sm-3"; } else { echo "col-sm-4"; } ?>">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Course Price (In $) <span style="color:red">*</span></label>
                                                <input type="text" name="frm[price]" value="<?= @$course->price ?>" class="form-control price" id="exampleInputEmail1" placeholder="Enter Price">
                                            </div>
                                        </div>
                                        <?php if(!empty($course->price_key)) { ?>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label for="exampleInputPrice1">Price ID (Stripe Price ID)</label>
                                                <input type="text" name="frm[price_key]" value="<?= $course->price_key ?>" class="form-control price_key" id="exampleInputPrice1" placeholder="Price ID (Stripe Price ID)" disabled>
                                            </div>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Certificate </label>
                                            <select class="form-control" name="frm[course_certificate]" id="course_certificate">
                                                <option value="">Choose</option>
                                                <option value="Certificate of Completion" <?php if ($course->course_certificate == 'Certificate of Completion') { echo "selected"; } ?>>Certificate of Completion</option>
                                                <option value="Certificate of Attendance" <?php if ($course->course_certificate == 'Certificate of Attendance') { echo "selected"; } ?>>Certificate of Attendance</option>
                                                <option value="BOTH" <?php if ($course->course_certificate == 'BOTH') { echo "selected"; } ?>>BOTH</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Entry Requirement</label>
                                            <input type="text" name="frm[requirement]" value="<?= $course->requirement ?>" class="form-control" id="exampleInputEmaila1" placeholder="Entry Requirement">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Who should Attend</label>
                                            <input type="text" name="frm[attended]" value="<?= $course->attended ?>" class="form-control" id="exampleInputEmaila1" placeholder="Who should Attend">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Assign Student</label>
                                            <select class="form-control" name="frm[assign_student][]" id="assign_student" multiple>
                                                <option value="">Choose Student</option>
                                                <?php
                                                $getStudentList = $this->db->query("SELECT * FROM users where email_verified = '1' AND status = '1' AND userType = '1'")->result_array();
                                                if(!empty($getStudentList)) {
                                                    foreach ($getStudentList as $ins) { ?>
                                                    <option value = "<?= $ins['id']; ?>"
                                                    <?php if(!empty(@$course->assign_student)) {
                                                        $student = explode(",", @$course->assign_student);
                                                        for($i=0; $i<count($student); $i++) {
                                                            if($student[$i] == $ins['id']){
                                                                echo "selected";
                                                            }
                                                        }
                                                    } ?>><?= $ins['full_name'] ?></option>
                                                <?php }
                                                } else { ?>
                                                <option value="">No Instructor Found</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Assign Instructor</label>
                                            <select class="form-control" name="frm[assigned_instrustor]" id="assigned_instrustor">
                                                <option value="">Choose Instructor</option>
                                                <?php
                                                $getInstructorList = $this->db->query("SELECT * FROM users where email_verified = '1' AND status = '1' AND userType = '2'")->result_array();
                                                if(!empty($getInstructorList)) {
                                                    foreach ($getInstructorList as $ins) { ?>
                                                    <option value = "<?= $ins['id']; ?>" <?php if ($ins['id'] == @$course->assigned_instrustor) { echo "selected"; } ?>><?= $ins['full_name'] ?></option>
                                                <?php }
                                                } else { ?>
                                                <option value="">No Instructor Found</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <img src="<?= site_url('assets/images/courses/' . $course->image) ?>" onerror="this.src='<?= site_url() ?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                                            <label for="exampleInputEmail1">Image </label>
                                            <input type="file" name="image" value="<?= $course->video ?>" class="form-control" id="exampleInputEmail1">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Status <span style="color: red">*</span></label>
                                            <select name="frm[status]" class="form-control" required>
                                                <option value="">Choose</option>
                                                <option <?php if ($course->status == 1) { echo "selected"; } ?> value="1">Active</option>
                                                <option <?php if ($course->status == 0) { echo "selected"; } ?>value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary" id="btnSubmit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/css/select2.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.5/js/select2.full.min.js"></script>
<style>
.courseTypefield {display: none;}
</style>
<script>
$(document).ready(function () {
    var selectedCourseType = $('#course_fees').val();
    if (selectedCourseType == 'free') {
        $('.courseTypefield').hide();
        $('.price').val('');
        $('.price_key').val('');
        $('.price_key').prop('required', false);
    } else if (selectedCourseType == 'paid') {
        $('.courseTypefield').show();
        $('.price_key').prop('required', true);
    } else {
        $('.courseTypefield').hide();
    }

    $('#assign_student').select2({
        //tags: true,
        tokenSeparators: [','],
        placeholder: "Choose Student",
    });
});

$('#course_fees').change(function () {
    var selectedOption = $(this).val(); //alert(selectedOption);
    if (selectedOption == 'free') {
        $('.courseTypefield').hide();
        $('.price').val('');
        $('.price_key').val('');
        $('#payment_type').prop('required', false);
        $('#recurring_type').prop('required', false);
    } else if (selectedOption == 'paid') {
        $('.courseTypefield').show();
        $('#payment_type').prop('required', true);
        $('#recurring_type').prop('required', true);
        $('.price').prop('required', true);
    } else {
        $('.courseTypefield').hide();
        $('#payment_type').prop('required', false);
        $('#recurring_type').prop('required', false);
        $('.price').prop('required', false);
    }
});

$('#payment_type').change(function () {
    var selectedOption = $(this).val(); //alert(selectedOption);
    if (selectedOption == '1') {
        $('#recurring_type').prop('disabled', true);
        $("#exampleInputRecurring1").html('Recurring Type');
    } else if (selectedOption == '2') {
        $('#recurring_type').prop('disabled', false);
        $("#exampleInputRecurring1").html('Recurring Type <span style="color:red">*</span>');
        $('#recurring_type').prop('required', true);
    } else {
        $('#recurring_type').prop('disabled', true);
        $("#exampleInputRecurring1").html('Recurring Type');
    }
});

$('.course_title').keyup(function() {
    var course_name = $(this).val();
    $.ajax({
        url: '<?= admin_url("course/checkduplicatecourse") ?>', // Replace with your server-side endpoint
        type: 'POST',
        data: { course_name: course_name },
        success: function(response) {
            var data = JSON.parse(response);
            if (data.exists) {
                $('.course_name_error').text('Course name already exists. Please choose a different name.').show();
                $('.course_name_error').css('color', 'red');
                $('#btnSubmit').prop('disabled', true); // Disable the submit button
            } else {
                $('.course_name_error').text('Course name availabe.').show();
                $('.course_name_error').css('color', 'green');
                $('#btnSubmit').prop('disabled', false); // Enable the submit button
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
        }
    });
});

</script>