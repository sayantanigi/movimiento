<?php //$this->load->view ('header');?>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.js"></script>
<script type="text/javascript">
    $(function () {
        setTimeout(function () { $("#testdiv").fadeOut(1500); }, 5000)
        $('#btnclick').click(function () {
            $('#testdiv').show();
            setTimeout(function () { $("#testdiv").fadeOut(1500); }, 5000)
        })
    })
</script>
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
                    <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i>
                    </li>
                    <li> <span>Conference Management</span> </li>
                </ul>
            </div>
            <div class="alert alert-success alert-dismissable" style="padding:10px;">
                <button class="close" aria-hidden="true" data-dismiss="alert" type="button" style="right:0;"></button>
                <strong>
                    <?php
                    $last = end($this->uri->segments);
                    if ($last == "success") {
                        echo "Data Added Successfully ......";
                    }
                    if ($last == "successdelete") {
                        echo "Data Deleted Successfully ......";
                    }
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
                                        <div class="caption"> <i class="fa fa-gift"></i>Add Conference</div>
                                        <div class="tools"> 
                                            <a href="javascript:;" class="collapse"> </a> 
                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a> 
                                            <a href="javascript:;" class="reload"> </a> 
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <form action="<?php echo base_url() . 'supercontrol/conference/add_conference' ?>" class="form-horizontal form-bordered" method="post" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="form-group last">
                                                    <label class="control-label col-md-3">Image</label>
                                                    <div class="col-md-9">
                                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
                                                            </div>
                                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"> </div>
                                                            <div>
                                                                <span class="btn default btn-file">
                                                                    <span class="fileinput-new"> Select image </span>
                                                                    <span class="fileinput-exists"> Change </span>
                                                                    <input type="file" name="userfile" id="userfile" onchange="readURL(this)">
                                                                </span>
                                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix margin-top-10">
                                                            <span class="label label-danger">Format</span> jpg, jpeg, png, gif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Conference Title</label>
                                                    <div class="col-md-8">
                                                        <input type="text" name="conference_title" class="form-control" id="conference_title">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Description</label>
                                                    <div class="col-md-8">
                                                        <textarea name="conference_desc" class="form-control" id="pagedes"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Date</label>
                                                    <div class="col-md-8">
                                                        <input type="date" name="conference_date" class="form-control" id="conference_date">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Category</label>
                                                    <div class="col-md-8">
                                                        <select name="category" class="form-control">
                                                            <option value="">Select option</option>
                                                            <option value="foundation">Foundation</option>
                                                            <option value="institute">Institute</option>
                                                            <option value="network">Network</option>
                                                            <option value="webinar">Webinar</option>
                                                            <option value="Analyses Makutano">Analyses Makutano</option>
                                                            <option value="Working Papers">Working Papers</option>
                                                            <option value="RABA/ARBI">RABA/ARBI</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Attachment</label>
                                                    <div class="col-md-8">
                                                        <input type="file" name="attachment" id="attachment">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Status</label>
                                                    <div class="col-md-8">
                                                        <select name="status" class="form-control" id="status">
                                                            <option value="">Select option</option>
                                                            <option value="0">Inactive</option>
                                                            <option value="1">Active</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-actions">
                                                <div class="row">
                                                    <div class="col-md-offset-3 col-md-9">
                                                        <!--<button type="submit" class="btn red" name="submit" value="Submit"> <i class="fa fa-check"></i> Submit</button>-->
                                                        <?php echo form_submit(array('id' => 'submit', 'value' => 'Submit', 'class' => 'btn red')); ?>
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
<?php //$this->load->view ('footer');?>
<!-- <script>
$('INPUT[type="file"]').change(function () {
    var ext = this.value.match(/\.(.+)$/)[1];
    switch (ext) {
        case 'jpg':
        case 'jpeg':
        case 'png':
        case 'gif':
            $('#userfile').attr('disabled', false);
            break;
        default:
            alert('This is not an allowed file type.');
            this.value = '';
    }
});
</script> -->