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
                    <li> <a href="<?php echo base_url(); ?>supercontrol/home">Home</a> <i class="fa fa-circle"></i></li>
                    <li> <span>Supercontrol Panel</span> </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Conference edit</div>
                                        <div class="tools"> 
                                            <a href="javascript:;" class="collapse"> </a> 
                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a> 
                                            <a href="javascript:;" class="reload"> </a>
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <?php foreach ($ecms as $i) { ?>
                                            <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url() . 'supercontrol/conference/edit_conference' ?>" enctype="multipart/form-data">
                                                <div class="form-body">
                                                    <input type="hidden" name="conference_id" value="<?= $i->id; ?>">
                                                    <input type="hidden" name="conference_image" value="<?= $i->image; ?>">
                                                    <input type="hidden" name="conference_attachment" value="<?= $i->attachment; ?>">
                                                    <div class="form-group last">
                                                        <label class="control-label col-md-3">Image</label>
                                                        <div class="col-md-9">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <?php if ($i->image == '') { ?>
                                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> 
                                                                <?php } else { ?> 
                                                                <img src="<?php echo base_url() ?>uploads/conference/<?php echo $i->image; ?>" alt="" /> 
                                                                <?php } ?>      
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
                                                            <input type="text" class="form-control" id="conference_title" value="<?php echo $i->title; ?>" name="conference_title">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Descriptions</label>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control" name="conference_desc" rows="6" id="pagedes"><?php echo $i->description; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Date</label>
                                                        <div class="col-md-8">
                                                            <input type="date" name="conference_date" class="form-control" id="conference_date" value="<?php echo $i->date; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Category</label>
                                                        <div class="col-md-8">
                                                            <select name="category" class="form-control">
                                                                <option value="">Select option</option>
                                                                <option value="foundation" <?php if ($i->category == 'foundation') { echo 'selected';} ?>>Foundation</option>
                                                                <option value="institute" <?php if ($i->category == 'institute') { echo 'selected';} ?>>Institute</option>
                                                                <option value="network" <?php if ($i->category == 'network') { echo 'selected';} ?>>Network</option>
                                                                <option value="webinar" <?php if ($i->category == 'webinar') { echo 'selected';} ?>>Webinar</option>
                                                                <option value="Analyses Makutano" <?php if ($conference->category == 'Analyses Makutano') { echo 'selected';} ?>>Analyses Makutano</option>
                                                                <option value="Working Papers" <?php if ($conference->category == 'Working Papers') { echo 'selected';} ?>>Working Papers</option>
                                                                <option value="RABA/ARBI" <?php if ($conference->category == 'RABA/ARBI') { echo 'selected';} ?>>RABA/ARBI</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label class="control-label col-md-3">Attachment</label>
                                                    <div class="col-md-8">
                                                        <input type="file" name="attachment" id="attachment">
                                                        <?php if ($i->attachment == '') { ?>
                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> 
                                                        <?php } else { ?> 
                                                        <a href="<?php echo base_url() ?>uploads/conference/<?php echo $i->attachment; ?>" alt="">File Attachment</a> 
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Status</label>
                                                    <div class="col-md-8">
                                                        <select name="status" class="form-control" id="status">
                                                            <option value="">Select option</option>
                                                            <option value="0" <?php if ($i->status == '0') { echo 'selected'; } ?>>Inactive</option>
                                                            <option value="1" <?php if ($i->status == '1') { echo 'selected'; } ?>>Active</option>
                                                        </select>
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
                                        <!-- END FORM-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END CONTENT BODY -->
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    <!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<?php //$this->load->view ('footer');?>