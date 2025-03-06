<?php //$this->load->view ('header');?>
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <?php $this->load->view ('leftbar');?>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN THEME PANEL -->
                    
                    <!-- END THEME PANEL -->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>supercontrol Panel</span>
                            </li>
                        </ul>
                        <div class="page-toolbar">
                            <div class="btn-group pull-right">
                                <button type="button" class="btn green btn-sm btn-outline dropdown-toggle" data-toggle="dropdown"> Actions
                                    <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right" role="menu">
                                    <li>
                                        <a href="#">
                                            <i class="icon-bell"></i> Action</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-shield"></i> Another action</a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-user"></i> Something else here</a>
                                    </li>
                                    <li class="divider"> </li>
                                    <li>
                                        <a href="#">
                                            <i class="icon-bag"></i> Separated link</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tabbable-line boxless tabbable-reversed">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab_0">
                                        <div class="portlet box blue-hoki">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-gift"></i>Add Gallery</div>
                                                <div class="tools">
                                                    <a href="javascript:;" class="collapse"> </a>
                                                    <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                                    <a href="javascript:;" class="reload"> </a>
                                                    <a href="javascript:;" class="remove"> </a>
                                                </div>
                                            </div>
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <form action="<?php echo base_url()?>index.php/gallery/add_gallery" method="post" class="form-horizontal" enctype="multipart/form-data"> 
                                                    <?php
													//form validation
													echo validation_errors();
													?>  
                                                    <div class="form-body">
                                                        <div class="form-group">
                                                            <b> <label class="col-md-3 control-label">Gallery Type</label> </b>
                                                            <div class="col-md-4">
                                                                 <select name="type" id="type" class="form-control" required>
                                                                    <option value="">Choose Category</option>
                                                                   <?php
                                                                        
                                                                        foreach($emember as $i){
                                                                        ?>
                                                                    <option value="<?php echo $i->id?>"><?php echo $i->gallery_type?></option>
                                                                    <?php } ?>
                                                                 </select>
                                                            </div>
                                                        </div>
                                                        
														<div class="form-group">
                                                            <b> <label class="col-md-3 control-label">Gallery Image</label> </b>
                                                            <div class="col-md-4">
                                                                <input type="file" name="image"  id="image" class="form-control"  required />
                                                            </div>
                                                        </div>
														
														<div class="form-group">
                                                            <b> <label class="col-md-3 control-label">Gallery Title</label> </b>
                                                            <div class="col-md-4">
                                                                 <input type="text" name="title" class="form-control" placeholder="Gallery Title" required />
                                                            </div>
                                                        </div>
														
														
														
														<div class="form-group">
                                                            <b> <label class="col-md-3 control-label">Description</label> </b>
                                                            <div class="col-md-4">
                                                                 <textarea class="form-control" name="description" rows="5" cols="10" id="description" placeholder="Description" required /></textarea>
                                                            </div>
                                                        </div>
														
														
													
                                                    </div>
                                                    <div class="form-actions top">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-9">
                                                                <button type="submit" class="btn green">Submit</button>
                                                                <a href="<?php echo base_url()?>index.php/gallery/show_gallery"><button type="button" class="btn default">Cancel</button></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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
        