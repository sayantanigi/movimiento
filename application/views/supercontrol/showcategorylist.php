<style>
#sample_1_filter {
    padding: 8px;
    float: right;
}

#sample_1_length {
    padding: 8px;
}

#sample_1_info {
    padding: 8px;
}

#sample_1_paginate {
    float: right;
    padding: 8px;
}
.dataTables_info {
    padding: 7px;
}
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
                    <li> <a href="<?php echo base_url(); ?>user/dashboard">Home</a> <i class="fa fa-circle"></i> </li>
                    <li> <span>Admin Panel</span> <i class="fa fa-circle"></i> </li>
                    <li> <span>Show Category List </span> </li>
                </ul>
            </div>
            <?php if ($this->session->flashdata('success') != '') { ?>
            <div class="alert alert-success">
                <center>
                    <?php echo @$this->session->flashdata('success'); ?>
                </center>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Show Category</div>
                                        <div class="tools"> 
                                            <a href="javascript:;" class="collapse"> </a>
                                            <a href="javascript:;" class="reload"> </a>
                                            <a href="javascript:;" class="remove"> </a>
                                        </div>
                                    </div>
                                    <table class="table table-striped" id="">
                                        <tr>
                                            <td>
                                                <div class="portlet-body form">
                                                    <?php /*echo $categorieslisting;*/?>
                                                    <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1" style="text-align: center;">
                                                        <div id="mydiv">
                                                            <thead>
                                                                <th style="max-width:50%; text-align:center;">Category List</th>
                                                                <th style="max-width:50%; text-align:center;">Action</th>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (is_array($eloca)): ?>
                                                                <?php
                                                                $ctn = 1;
                                                                foreach ($eloca as $i) { ?>
                                                                <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                                                    <td style="max-width:200px;"><?php echo $i->category_name; ?> </td>
                                                                    <td>
                                                                        <a class="btn green sbold uppercase btn-xs" href="<?php echo base_url() ?>supercontrol/category/show_category_id/<?php echo $i->id; ?>">Edit</a> | 
                                                                        <a class="btn red sbold uppercase btn-xs" onclick="return confirm('Are you sure about this delete?');" href="<?php echo base_url() ?>supercontrol/category/delete_category/<?php echo $i->id; ?>">Delete</a>
                                                                    </td>
                                                                </tr>
                                                                <?php $ctn++; } ?>
                                                                <?php endif; ?>
                                                            </tbody>
                                                        </div>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
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
<?php //$this->load->view ('footer');?>