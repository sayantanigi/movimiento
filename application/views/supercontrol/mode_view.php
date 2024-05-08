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
                    <li>
                        <a href="<?php echo base_url(); ?>supercontrol/home">Home</a>
                        <i class="fa fa-circle"></i>
                    </li>
                    <li>
                        <span>supercontrol Panel</span>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-gift"></i>Mode View</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                            <a href="javascript:;" class="reload"> </a>
                                            <a href="javascript:;" class="remove"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <?php foreach($ecms as $i) { ?>
                                        <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                            <tr><td >Mode Title :</td>  <td><?php echo $i->mode_title;?></td></tr>
                                        </table>
                                        <?php }?> 
                                        <div style="margin-left:537px;">
                                            <td style="max-width:70px;">
                                                <a class="btn green btn-sm btn-outline sbold uppercase" href="<?php echo base_url()?>supercontrol/mode/show_mode" style="width:70px; margin-left: 450px; margin-bottom: 20px;">Back</a>
                                            </td>
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
</div>
<?php //$this->load->view ('footer');?>
