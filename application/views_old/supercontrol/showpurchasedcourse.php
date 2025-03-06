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
                    <li> <span>SuperControl Panel</span> <i class="fa fa-circle"></i> </li>
                    <li> <span>Show Purchased List </span> </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i>Show Purchased List</div>
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
                                                                <tr>
                                                                    <th style="text-align: center;">Sl No.</th>
                                                                    <th style="text-align: center;">TXN ID</th>
                                                                    <th style="text-align: center;">Course Name</th>
                                                                    <th style="text-align: center;">Purchased By</th>
                                                                    <th style="text-align: center;">Price</th>
                                                                    <th style="text-align: center;">Status</th>
                                                                    <th style="text-align: center;">Enrollment Date</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php if (is_array($getPurchasedList)): ?>
                                                                <?php
                                                                $ctn = 1;
                                                                foreach ($getPurchasedList as $i) { ?>
                                                                <tr>
                                                                    <td><?= $ctn ?></td>
                                                                    <td><?= $i['transaction_id']?></td>
                                                                    <td>
                                                                        <?php $order_item = $this->db->query("SELECT * FROM courses WHERE id = '".$i['course_id']."'")->row();
                                                                        echo $order_item->title; ?>
                                                                    </td>
                                                                    <td>
                                                                    <?php
                                                                    $getUserdata = $this->db->query("SELECT full_name FROM users WHERE id = '".$i['user_id']."'")->row();
                                                                    echo $getUserdata->full_name;
                                                                    ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if($i['price_cents'] > 0) {
                                                                            echo "$".$i['enrollment_price'];
                                                                        } else {
                                                                            echo "Free";
                                                                        } ?></td>
                                                                    <td><?= $i['payment_status']?></td>
                                                                    <td><?= date('d-m-Y', strtotime($i['enrollment_date'])) ?></td>
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
<script>
 $(document).ready( function () {
    $('#sample_1').DataTable();
});
</script>