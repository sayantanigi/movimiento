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
                    <li> <span>supercontrol Panel</span> </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>News edit</div>
                                        <div class="tools"> 
                                            <a href="javascript:;" class="collapse"> </a> 
                                            <a href="#portlet-config" data-toggle="modal" class="config"> </a> 
                                            <a href="javascript:;" class="reload"> </a>
                                            <a href="javascript:;" class="remove"> </a> 
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <?php foreach ($ecms as $i) { ?>
                                            <form method="post" class="form-horizontal form-bordered" action="<?php echo base_url() . 'supercontrol/news/edit_news ' ?>" enctype="multipart/form-data">
                                                <div class="form-body">
                                                    <input type="hidden" name="news_id" value="<?= $i->id; ?>">
                                                    <input type="hidden" name="news_image" value="<?= $i->image; ?>">
                                                    <div class="form-group last">
                                                        <label class="control-label col-md-3">Image</label>
                                                        <div class="col-md-9">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                                <?php if ($i->image == '') { ?>
                                                                    <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" /> 
                                                                <?php } else { ?> 
                                                                <img src="<?php echo base_url() ?>uploads/blog/<?php echo $i->image; ?>" alt="" /> 
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
                                                        <label class="control-label col-md-3">News Title</label>
                                                        <div class="col-md-8">
                                                            <input type="text" class="form-control" id="news_title" value="<?php echo $i->title; ?>" name="news_title">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-3">Descriptions</label>
                                                        <div class="col-md-8">
                                                            <textarea class="form-control" name="news_desc" rows="6" id="pagedes"><?php echo $i->description; ?></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <label class="control-label col-md-3">Type</label>
                                                    <div class="col-md-8">
                                                        <select name="popular" class="form-control" id="popular">
                                                            <option value="">Select option</option>
                                                            <option value="blog" <?php if ($i->popular == 'blog') { echo 'selected'; } ?>>Blog</option>
                                                            <option value="news" <?php if ($i->popular == 'news') { echo 'selected'; } ?>>News</option>
                                                            <option value="press" <?php if ($i->popular == 'press') { echo 'selected'; } ?>>Press</option>
                                                            <option value="inv_kit" <?php if ($i->popular == 'inv_kit') { echo 'selected'; } ?>>Investor Kit</option>
                                                        </select>
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