<?php //$this->load->view ('header');
$this->load->model('generalmodel');
$this->load->model('supercontrol/instructor_model');
error_reporting(0);
?>
<script>
$(document).ready(function(){
    $("#check").click(function(){
        $("#drop").show(1000);
        $("#check").hide();
        $("#check2").show();
    });
    
    $("#check2").click(function(){
        $("#drop").hide(1000);
        $("#check").show();
        $("#check2").hide();
    });
});	
</script>
<script>
$(document).ready(function () {
    $('label').click(function() {
        $('.active').removeClass("active");
    $(this).addClass("active");
    });
});
</script>
<div class="page-container">
    <div class="page-sidebar-wrapper">
        <div class="page-sidebar navbar-collapse collapse">
            <?php $this->load->view ('supercontrol/leftbar');?>
        </div>
    </div>
    <div class="page-content-wrapper">
        <div class="page-content">
            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li> <a href="<?php echo base_url(); ?>supercontrol/user/dashboard">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Admin panel</span> </li>
                </ul>
            </div>
            <div class="alert alert-success alert-dismissable" style="padding:10px;">
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
                <strong>
                <?php 
                    if(@$success_msg!=''){echo @$success_msg;}
                    $last = end($this->uri->segments); 
                    if($last=="success"){echo "course Added Successfully ......";}
                    if($last=="successdelete"){echo "course Deleted Successfully ......";}
                ?>
                </strong>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Course Bookings Details</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"></a>
                                            <a href="javascript:;" class="reload"></a>
                                            <a href="javascript:;" class="remove"></a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form"> 
                                        <?php foreach($couserdetails as $c){?>
                                        <form action="<?php echo base_url().'supercontrol/course/edit_course'?>" class="form-horizontal" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="course_id" value="<?=$c->id;?>">
                                            <input type="hidden" name="course_image" value="<?php echo $c->course_image;?>">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <div class="col-md-12"><p class="col-md-12 control-label">Course Name: <?=$c->title;?></p></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-8">
                                                        <p class="col-md-3 control-label">Category:
                                                        <?php 
                                                        $id1 = $allcat[0]->id;
                                                        $id2 = $c->cat_id;
                                                        $result = $this->generalmodel->course_view($id1,$id2);
                                                        echo $result[0]->category_name."</p>";
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-8"><label class="col-md-3 control-label">Course Type</label><?=$c->course_type;?></div>
                                                </div>
                                                <div class="form-group">
                                                    <b><label class="col-md-3 control-label">Price</label></b>
                                                    <div class="col-md-8"><?=$c->price;?></div>
                                                </div>
                                                <div class="form-group">
                                                    <b><label class="col-md-3 control-label">Certificate</label></b>
                                                    <div class="col-md-8"><?=$c->course_certificate;?></div>
                                                </div>
                                                <div class="form-group">
                                                    <b><label class="col-md-3 control-label">Entry Requirement</label></b>
                                                    <div class="col-md-8"><?=$c->requirement;?></div>
                                                </div>
                                                <div class="form-group">
                                                    <b><label class="col-md-3 control-label">Description</label></b>
                                                    <div class="col-md-8">
                                                        <?=$c->description;?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9"> </div>
                                                </div>
                                            </div>
                                        </form>
                                        <?php  } ?>
                                        <h3>Instructor Details </h3>
                                        <?php foreach($course as $dd) { 
                                        $caa=$dd->course_id;
                                        //echo $cidaa;
                                        $queryallcat= $this->instructor_model->show_course_inst($caa);
                                        //echo $this->db->last_query(); exit();
                                        foreach ($queryallcat as $e) {
                                            $instructor=$this->instructor_model->show_member_id($e->instructor_id);
                                            //echo $this->db->last_query(); exit();
                                        ?>
                                        <div class="row">
                                            <div class="form-group">
                                                <b><label class="col-md-3 control-label">Instructor :</label></b>
                                                <div class="col-md-8"><?php echo $instructor->first_name; ?> &nbsp; <?php echo $instructor->last_name; ?></div>
                                            </div>
                                        </div>
                                        <?php } } ?>
                                        <h3>Student Bookings  Details </h3>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Mode</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(!empty($allbook)) {
                                                foreach ($allbook as  $book) {
                                                $stu=$book->student_id;
                                                $studetails=$this->generalmodel->fetch_single_join("Select * from sm_member where email='$stu'"); ?>
                                                <tr>
                                                    <td><?php echo $studetails->first_name; ?> &nbsp;<?php echo $studetails->last_name; ?> </td>
                                                    <td><?php echo $studetails->email; ?></td>
                                                    <td><?php echo $studetails->phoneno; ?></td>
                                                    <td><?php echo $book->mode; ?></td>
                                                </tr>
                                                <?php } } else {?>
                                                <tr>
                                                    <td colspan="4">No Booking List</td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
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
<style type="text/css">
label {width: 125px;display: block;float: left;}
label input {display: none;}
label span {display: block;width: 17px;height: 17px;border: 1px solid black;float: left;margin: 0 5px 0 0;position: relative;}
label.active span:after {content: " ";position: absolute;left: 3px;right: 3px;top: 3px;bottom: 3px;background: black;}
.topul li {list-style-type:none;}
#errorBox{color:#F00;}
</style>
<script>
function check() {
    if($("#title").val() == "" ){
        $("#title").focus();
        $("#errorBox").html("Please Enter Project Type or course");
        return false;
    } else {
        $("#errorBox").html("");
    }
}

function leftTrim(element){
    if(element)
    element.value=element.value.replace(/^\s+/,"");
}
</script>
<?php //$this->load->view ('footer');?>
