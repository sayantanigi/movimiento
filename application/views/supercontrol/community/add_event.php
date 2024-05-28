<?php //$this->load->view ('header');?>
<style type="text/css">
label { width: 125px; display: block; float: left; }
label input { display: none; }
label span { display: block; width: 17px; height: 17px; border: 1px solid black; float: left; margin: 0 5px 0 0; position: relative; }
label.active span:after { content: " "; position: absolute; left: 3px; right: 3px; top: 3px; bottom: 3px; background: black; }
.topul li { list-style-type: none; }
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
                    <li>
                        <a href="<?php echo base_url(); ?>supercontrol/user/dashboard">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li> <span>Admin panel</span> </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-body form">
                                        <!-- BEGIN FORM-->
                                        <form action="<?php echo base_url().'supercontrol/community/add_event/'.$community->id?>" class="form-horizontal" method="post" enctype="multipart/form-data" onsubmit="check()">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Title *</b></label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="frm[title]" required="" id="title" class="form-control" placeholder="Title" onkeyup="leftTrim(this)" value="<?= $community->title ?>"/>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Description</b></label>
                                                    <div class="col-md-8">
                                                        <textarea id="pagedes" class="form-control" name="frm[description]" cols="60" rows="10" aria-hidden="true"><?= $community->description ?></textarea>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label"><b>Type</b></label>
                                                    <div class="col-md-8">
                                                        <select name="frm[cat_id]" class="form-control">
                                                            <option value="">Select option</option>
                                                            <?php
                                                            if(!empty($community_cat)) {
                                                            foreach ($community_cat as $community_cat_v) { ?>
                                                            <option value="<?= $community_cat_v['id']?>" <?php if($community_cat_v['id'] == $community->cat_id) { echo "selected"; }?>><?= $community_cat_v['category_name']?></option>
                                                            <?php } } else { ?>
                                                            <option value="">No Data</option>
                                                            <?php } ?>
                                                        </select>
                                                        <label id="errorBox"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <input type="submit" id="submit" value="Submit" class="btn red">
                                                        <button type="button" class="btn default">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
#errorBox {color: #F00;}
#tab_0 {display: block !important;}
.courseTypefield {display: none;}
</style>
<!-- <script src="<?php echo base_url(); ?>js/jquery.datetimepicker.full.js"></script> -->
<script src="https://cdn.ckeditor.com/4.11.2/standard/ckeditor.js"></script>
<script>
$(document).ready(function () {
    var selectedCourseType = $('#course_fees').val();
    if (selectedCourseType == 'free') {
        $('.courseTypefield').hide();
        $('.price').val('');
        $('.price_key').val('');
        $('.price').prop('required', false);
        $('.price_key').prop('required', false);
    } else if (selectedCourseType == 'paid') {
        $('.courseTypefield').show();
        $('.price').prop('required', true);
        $('.price_key').prop('required', true);
    } else {
        $('.courseTypefield').hide();
        $('.price').prop('required', false);
        $('.price_key').prop('required', false);
    }
});

$('#course_fees').change(function () {
    var selectedOption = $(this).val(); //alert(selectedOption);
    if (selectedOption == 'free') {
        $('.courseTypefield').hide();
        $('.price').val('');
        $('.price_key').val('');
        $('.price').prop('required', false);
        $('.price_key').prop('required', false);
    } else if (selectedOption == 'paid') {
        $('.courseTypefield').show();
        $('.price').prop('required', true);
        $('.price_key').prop('required', true);
    } else {
        $('.courseTypefield').hide();
        $('.price').prop('required', false);
        $('.price_key').prop('required', false);
    }
})
</script>
<?php //$this->load->view ('footer');?>