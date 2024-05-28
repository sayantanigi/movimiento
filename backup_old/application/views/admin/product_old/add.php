<!-- Main content -->
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
                    <!-- <h3 class="box-title">Add Service</h3> -->
                </div>
                <form action="<?= admin_url('course/add_course/' . $course->id) ?>" id="form_validation" method="post" enctype="multipart/form-data">
                    <div class="box-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-10">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Category</label>
                                            <select name="frm[cat_id]" class="form-control">
                                                <option value="">Choose</option>
                                                <?php foreach ($course_cat as $cat) { ?>
                                                <option <?php if (@$course->cat_id == $cat['id']) { echo "selected"; } ?> value="<?= $cat['id'] ?>"><?= $cat['category_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Mode</label>
                                            <select name="frm[mode_id]" class="form-control">
                                                <option value="">Choose</option>
                                                <?php foreach ($course_mode as $mode) { ?>
                                                <option <?php if (@$course->mode_id == $mode['id']) { echo "selected"; } ?> value="<?= $mode['id'] ?>"><?= $mode['mode_title'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Level</label>
                                            <select name="frm[level_id]" class="form-control">
                                                <option value="">Choose</option>
                                                <?php foreach ($course_level as $level) { ?>
                                                <option <?php if (@$course->level_id == $level['id']) { echo "selected"; } ?> value="<?= $level['id'] ?>"> <?= $level['level_title'] ?> </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Name</label>
                                            <input type="text" name="frm[title]" value="<?= $course->title ?>" class="form-control" id="exampleInputEmail1" placeholder="Enter Course Name">
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
                                <!-- <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                        <label for="exampleInputEmail1">Course Benefits</label>
                                        <textarea name="frm[meta_descr]" class="form-control" rows="3"><?= $course->meta_descr ?></textarea>
                                        </div>
                                    </div>
                                </div> -->
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
                                            <!-- <textarea name="frm[duration]" id="editor5" rows="3"><?= $course->duration ?></textarea> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Fees <span style="color: red">*</span></label>
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
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Course Price(In $)</label>
                                                <input type="text" name="frm[price]" value="<?= @$course->price ?>" class="form-control price" id="exampleInputEmail1" placeholder="Enter Price">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Price ID (Stripe Price ID) <span style="color: red">*</span></label>
                                                <input type="text" name="frm[price_key]" value="<?= $course->price_key ?>" class="form-control price_key" id="exampleInputEmaila1" placeholder="Price ID (Stripe Price ID)" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Type<span style="color: red">*</span></label>
                                            <select class="form-control" name="frm[course_type]" id="course_type" required>
                                                <option value="">Choose</option>
                                                <option value="Upcoming Courses" <?php if ($course->course_type == 'Upcoming Courses') { echo "selected"; } ?>>Upcoming Courses</option>
                                                <option value="Coming Soon Courses" <?php if ($course->course_type == 'Coming Soon Courses') { echo "selected"; } ?>>Coming Soon Courses</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-10">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="exampleInputEmail1">Course Certificate <span style="color: red">*</span></label>
                                            <select class="form-control" name="frm[course_certificate]" id="course_certificate" required>
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
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <img src="<?= site_url('assets/images/courses/' . $course->image) ?>" onerror="this.src='<?= site_url() ?>assets/images/no-image.png';" class="img-responsive" style="width:100px">
                                            <label for="exampleInputEmail1">Image</label>
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
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>
<style>
.courseTypefield {
    display: none;
}
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
});

$('#course_fees').change(function () {
    var selectedOption = $(this).val(); //alert(selectedOption);
    if (selectedOption == 'free') {
        $('.courseTypefield').hide();
        $('.price').val('');
        $('.price_key').val('');
        $('.price_key').prop('required', false);
    } else if (selectedOption == 'paid') {
        $('.courseTypefield').show();
        $('.price_key').prop('required', true);
    } else {
        $('.courseTypefield').hide();
    }
})
</script>