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
                        <a href="<?php echo base_url(); ?>supercontrol/user/dashboard">Home</a> <i class="fa fa-circle"></i>
                    </li>
                    <li> <span>Admin Panel</span> </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Category edit</div>
                                        <div class="tools"> <a href="javascript:;" class="collapse"> </a>
                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                            <a href="javascript:;" class="reload"> </a>
                                            <a href="javascript:;" class="remove"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <?php foreach ($eallcat as $i) { ?>
                                        <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url() . 'supercontrol/category/edit_category' ?>" enctype="multipart/form-data" onsubmit="return check();">
                                            <div class="form-body">
                                                <input type="hidden" name="category_id" value="<?= $i['id']; ?>">
                                                <div class="form-group">
                                                    <label class="control-label col-md-3"><p> Category </p></label>
                                                    <div class="col-md-5">
                                                        <input type="text" class="form-control" id="category_name" value="<?php echo $i['category_name']; ?>" name="category_name" onkeyup="leftTrim(this)">
                                                        <div id="errorBox"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <input type="submit" class="btn red" id="submit" value="Submit"
                                                            name="update">
                                                        <button class="btn default" type="button">Cancel</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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
<script>
function check() {
    if ($("#category_name").val() == "") {
        $("#category_name").focus();
        $("#errorBox").html("Please Enter Project Type or Category");
        return false;
    } else {
        $("#errorBox").html("");
    }
}

function leftTrim(element) {
    if (element)
        element.value = element.value.replace(/^\s+/, "");
}
</script>
<style>
#errorBox {
    color: #F00;
}
</style>
<?php //$this->load->view ('footer');?>