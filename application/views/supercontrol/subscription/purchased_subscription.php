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
                    <li><span>Home</span><i class="fa fa-circle"></i> </li>
                    <li><span>Supercontrol Panel</span> <i class="fa fa-circle"></i></li>
                    <li><span>Show Purchased Subscription List </span></li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="tabbable-line boxless tabbable-reversed showcase_buttons">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_0">
                                <div class="portlet box blue-hoki">
                                    <div class="portlet-title">
                                        <div class="caption"> <i class="fa fa-gift"></i> Purchased Subscription List </div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse"> </a>
                                            <a href="javascript:;" class="reload"> </a>
                                            <a href="javascript:;" class="remove"> </a>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive cstm_courselist" id="sample_1">
                                                <thead>
                                                    <tr>
                                                        <th width="25%">Transaction ID</th>
                                                        <th>Subscription Name</th>
                                                        <th>Description</th>
                                                        <th>Subscription Amount</th>
                                                        <th>Payment Status</th>
                                                        <th>Payment Date </th>
                                                        <th>Expiry Date </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if (is_array($sub_data)):
                                                    $ctn = 1;
                                                    foreach ($sub_data as $sub) {
                                                        $subscriptionDetails = $this->db->query("SELECT * FROM subscription WHERE id = '".@$sub['subscription_id']."'")->row();
                                                        $string = strip_tags($subscriptionDetails->subscription_description);
                                                        if (strlen($string) > 100) {
                                                            $stringCut = substr($string, 0, 100);
                                                            $endPoint = strrpos($stringCut, ' ');
                                                            //if the string doesn't contain any space then it will cut without word basis.
                                                            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                                                            $string .= '... ';
                                                        }
                                                    ?>
                                                    <tr class="table table-striped table-bordered table-hover table-checkable order-column dt-responsive" id="sample_1">
                                                        <td><?php echo $sub['transaction_id']; ?></td>
                                                        <td><?php echo $subscriptionDetails->subscription_name; ?></td>
                                                        <td><?php echo $subscriptionDetails->subscription_description; ?> </td>
                                                        <td><?php if(!empty($subscriptionDetails->subscription_amount)) { echo "$".$subscriptionDetails->subscription_amount; } else { echo "Free"; } ?></td>
                                                        <td><?php echo ucwords($sub['payment_status']); ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($sub['payment_date'])); ?></td>
                                                        <td><?php echo date('d-m-Y', strtotime($sub['expiry_date'])); ?></td>
                                                    </tr>
                                                    <?php $ctn++; } ?>
                                                    <?php endif; ?>
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
</div>